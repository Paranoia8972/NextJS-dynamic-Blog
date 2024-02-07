import * as React from "react";
import Link from "next/link";

export default function PostCard() {
  return (
    <div className="flex flex-col w-[400px] my-2">
      <Link href="/path-to-your-post">
          <img
            src="https://picsum.photos/400/200"
            alt="Alt"
            className="h-[200px] w-[400px] rounded-xl object-cover cursor-pointer"
          />
        <p className="font-bold text-2xl px-4 cursor-pointer mt-2">Title</p>
      </Link>
      <p className="text-sm text-gray-400 font-light px-4 mt-[-2px]">
        Jan 25, 2024
      </p>
    </div>
  );
}
