import React from "react";
import Pagination from "@/components/Pagination";
import Image from "next/image";
import Card from "@/components/Card";

const getData = async (page, cat) => {
  const res = await fetch(
    `${process.env.BASE_URL}/api/posts?page=${page}&cat=${cat || ""}`,
    {
      cache: "no-store",
    }
  );

  if (!res.ok) {
    throw new Error("Failed");
  }

  return res.json();
};

const CardList = async ({ page, cat }) => {
  const { posts, count } = await getData(page, cat);

  const POST_PER_PAGE = 2;

  const hasPrev = POST_PER_PAGE * (page - 1) > 0;
  const hasNext = POST_PER_PAGE * (page - 1) + POST_PER_PAGE < count;


  const pageNumbers = [];

  return (
    <div className="mx-auto flex-[5]">
      <div className="container grid grid-cols-1 justify-center gap-6 px-4 md:grid-cols-2 md:gap-8 lg:grid-cols-3 lg:gap-10 xl:px-10 xl:py-10 2xl:px-24 2xl:py-5">
        {posts?.map((item) => (
          <Card item={item} key={item.id} />
        ))}
      </div>
      <Pagination page={page} hasPrev={hasPrev} hasNext={hasNext} />
    </div>
  );
};

export default CardList;
