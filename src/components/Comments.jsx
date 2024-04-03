"use client";
import Link from "next/link";
import Image from "next/image";
import useSWR from "swr";
import { useSession } from "next-auth/react";
import { useState } from "react";

const fetcher = async (url) => {
  const res = await fetch(url);
  const data = await res.json();
  if (!res.ok) {
    const error = new Error(data.message);
    throw error;
  }
  return data;
};

const Comments = ({ postSlug }) => {
  const { status } = useSession();
  const { data, mutate, isLoading } = useSWR(
    `/api/comments?postSlug=${postSlug}`,
    fetcher
  );

  const [desc, setDesc] = useState("");
  const handleSubmit = async () => {
    await fetch("/api/comments", {
      method: "POST",
      body: JSON.stringify({ desc, postSlug }),
    });
    mutate();
  };

  return (
    <div className="mt-[50px]">
      <h1 className="text-[color:var(--softTextColor)] mb-[30px]">Comments</h1>
      {status === "authenticated" ? (
        <div className="flex items-center justify-between gap-[30px]">
          <textarea
            placeholder="write a comment..."
            className="w-full p-5"
            onChange={(e) => setDesc(e.target.value)}
          />
          <button className="bg-[teal] text-[white] font-[bold] cursor-pointer px-5 py-4 rounded-[5px] border-[none]" onClick={handleSubmit}>
            Send
          </button>
        </div>
      ) : (
        <Link href="/login">Login to write a comment</Link>
      )}
      <div className="mt-[50px]">
        {isLoading
          ? "loading"
          : data?.map((item) => (
            <div className="mb-[50px]" key={item._id}>
              <div className="flex items-center gap-5 mb-5">
                {item?.user?.image && (
                  <Image
                    src={item.user.image}
                    alt=""
                    width={50}
                    height={50}
                    className="object-cover rounded-full"
                  />
                )}
                <div className="flex flex-col gap-[5px] text-[color:var(--softTextColor)]">
                  <span className="font-medium">{item.user.name}</span>
                  <span className="text-sm">{item.createdAt}</span>
                </div>
              </div>
              <p className="text-lg font-light">{item.desc}</p>
            </div>
          ))}
      </div>
    </div>
  );
};

export default Comments;
