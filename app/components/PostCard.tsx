import * as React from "react";
import Image from "next/image";
import client from "@/pb.config.js";

interface RecordModel {
  id: string;
  name: string;
  slug: string;
  published: boolean;
  image: string;
  created: string;
  collectionId: string;
}

interface PostCardProps {
  post: RecordModel;
  isAdmin: boolean;
}

export default function PostCard({ post, isAdmin }: PostCardProps) {
  const shouldDisplayPost = post.published || isAdmin;

  if (!shouldDisplayPost) {
    return null;
  }

  return (
    <div className="my-2 flex flex-col">
      <a href={`/post/${post.slug}`}>
        <Image
        src={`${client}/api/files/${post.collectionId}/${post.id}/${post.image}`}
          alt={post.name}
          className="border h-[200px] w-[400px] cursor-pointer rounded-xl object-cover"
          width={400}
          height={200}
        />
        <p className="mt-2 cursor-pointer px-4 text-2xl font-bold">
          {post.name}
        </p>
      </a>
      <p className="mt-[-2px] px-4 text-sm font-light text-gray-400">
        {new Date(post.created).toLocaleDateString("en-US", {
          month: "short",
          day: "numeric",
          year: "numeric",
        })}
      </p>
    </div>
  );
}
