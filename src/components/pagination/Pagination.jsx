"use client";

import React from "react";
import { useRouter } from "next/navigation";

const Pagination = ({ page, hasPrev, hasNext }) => {
  const router = useRouter();

  return (
    <div className="flex justify-between">
      <button
        className="disabled:cursor-not-allowed; w-[100px] cursor-pointer rounded-md border-[none] bg-[royalblue] p-4 text-white disabled:bg-[midnightblue]"
        disabled={!hasPrev}
        onClick={() => router.push(`?page=${page - 1}`)}
      >
        Previous
      </button>
      <button
        disabled={!hasNext}
        className="disabled:cursor-not-allowed; w-[100px] cursor-pointer border-[none] bg-[royalblue] p-4 text-white disabled:bg-[midnightblue]"
        onClick={() => router.push(`?page=${page + 1}`)}
      >
        Next
      </button>
    </div>
  );
};

export default Pagination;
