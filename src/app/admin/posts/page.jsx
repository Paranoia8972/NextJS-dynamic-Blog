import React from "react";

const getData = async (page, cat) => {
  const res = await fetch(`${process.env.PUBLIC_URL}/api/posts`, {
    cache: "no-store",
  });

  if (!res.ok) {
    throw new Error("Failed");
  }

  return res.json();
};

const PostPage = () => {
  let posts = [];

  const fetchPosts = async () => {
    try {
      posts = await getData();
    } catch (error) {
      console.error("Failed to fetch posts:", error);
    }
  };

  fetchPosts();

  return (
    <div>
      {posts.map((post, index) => (
        <div key={index}>
          <h2>{post.title}</h2>
          <p>{post.content}</p>
        </div>
      ))}
    </div>
  );
};

export default PostPage;
