import * as React from "react";
import PocketBase from "pocketbase";
const pb = new PocketBase("http://192.168.178.67:8090");
import PostCard from "@/app/components/PostCard";
import { PostSkeleton } from "./components/PostSkeleton";

export default function Home() {
  return (
    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 justify-items-center mx-[17rem] gap-4">
      <PostCard />
      <PostCard />
      <PostCard />
      <PostCard />
      {/* <PostSkeleton /> */}
    </div>
  );
}