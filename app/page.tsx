import * as React from "react";
import PostCard from "@/app/components/PostCard";

export default function Home() {
  return (
    <main className="flex-grow">
      <div className="container mx-auto grid grid-cols-1 justify-items-center gap-10 px-4 md:grid-cols-2 lg:grid-cols-3 xl:px-10 xl:py-10 2xl:px-24 2xl:py-5">
        <PostCard />
        <PostCard />
        <PostCard />
        <PostCard />
      </div>
    </main>
  );
}
