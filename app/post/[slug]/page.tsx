import * as React from "react";
import Image from "next/image";
import { GetServerSideProps } from "next";
import client from "@/pb.config.js";
import PocketBase from "pocketbase";

const pb = new PocketBase(client);

interface PostProps {
  post: {
    id: string;
    name: string;
    created: string;
    image: string;
    content: string;
    collectionId: string;
  };
}

export default function BlogArticle({ post }: PostProps) {
  return (
    <div className="mx-auto mt-8 w-[900px] px-8">
      <h1 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl">
        <span className="mt-2 block text-center font-bold leading-8 tracking-tight sm:text-4xl">
          {post.name}
        </span>
        <span className="block text-center text-base font-semibold uppercase tracking-wide text-primary">
          {new Date(post.created).toLocaleDateString("en-US", {
            month: "short",
            day: "numeric",
            year: "numeric",
          })}
        </span>
      </h1>
      <Image
        src={`${client}/api/files/${post.collectionId}/${post.id}/${post.image}`}
        alt={post.name}
        width={900}
        height={450}
        className="mx-auto mt-8 rounded-lg border"
      />
      <div className="prose prose-lg prose-blue mt-16 dark:prose-invert prose-a:text-primary prose-li:marker:text-primary">
        {post.content}
      </div>
    </div>
  );
}
