import * as React from "react";

export default function PostCard() {
  return (
    <div className="my-2 flex flex-col">
      <a href="/path-to-your-post">
        <img
          src="https://picsum.photos/400/200"
          alt="Alt"
          className="h-[200px] w-[400px] cursor-pointer rounded-xl object-cover"
        />
        <p className="mt-2 cursor-pointer px-4 text-2xl font-bold">Title</p>
      </a>
      <p className="mt-[-2px] px-4 text-sm font-light text-gray-400">
        Jan 25, 2024
      </p>
    </div>
  );
}
