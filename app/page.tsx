"use client";

import React, { useEffect, useState } from "react";
import PostCard from "@/app/components/PostCard";
import PocketBase, { RecordModel } from "pocketbase";
import client from "@/pb.config.js";

const pb = new PocketBase(client);

export default function Home() {
  const [posts, setPosts] = useState<RecordModel[]>([]);

  useEffect(() => {
    async function fetchPosts() {
      try {
        const records = await pb.collection("posts").getFullList({
          sort: "-created",
        });

        setPosts(records);
      } catch (error) {
        console.error("Failed to fetch posts:", error);
      }
    }

    fetchPosts();
  }, []);

  return (
    <main className="flex-grow">
      <div className="container mx-auto grid grid-cols-1 justify-items-center gap-10 px-4 md:grid-cols-2 lg:grid-cols-3 xl:px-10 xl:py-10   2xl:px-24   2xl:py-5">
        {posts.map((post) => (
          <PostCard key={post.id} post={post} />
        ))}
      </div>
    </main>
  );
}
