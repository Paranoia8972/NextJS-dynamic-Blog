import React from "react";
import Link from "next/link";
import Image from "next/image";
const getData = async () => {
  const res = await fetch(`${process.env.BASE_URL}/api/categories`, {
    cache: "no-store",
  });
  if (!res.ok) {
    throw new Error("Failed");
  }
  return res.json();
};
const CategoryList = async () => {
  const data = await getData();
  return (
    <div>
      <h1 className="my-[50px] text-2xl font-bold text-center">All Categories</h1>
      <div className="flex flex-wrap justify-between gap-5">
        {data?.map((item) => {
          return (
            <Link
              href={`/posts?cat=${item.slug}`}
              className="flex items-center gap-2.5 capitalize w-[15%] h-20 justify-center rounded-[10px] bg-blue-950"
              key={item._id}
            >
              {item.img && (
                <Image
                  src={item.img}
                  alt={item.title}
                  width={50}
                  height={50}
                  className="rounded-full aspect-square object-cover"
                />
              )}
              {item.title}
            </Link>
          );
        })}
      </div>
    </div>
  );
};

export default CategoryList;
