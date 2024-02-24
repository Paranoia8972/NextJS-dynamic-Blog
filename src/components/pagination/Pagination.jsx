"use client";

import React from "react";
import { useRouter } from "next/navigation";

const Pagination = ({ page, hasPrev, hasNext }) => {
  const router = useRouter();

  return (
    <div className="flex justify-between">
      <button
        className="w-[100px] bg-[royalblue] text-white cursor-pointer p-4 border-[none] rounded-md disabled:bg-[midnightblue] disabled:cursor-not-allowed;"
        disabled={!hasPrev}
        onClick={() => router.push(`?page=${page - 1}`)}>
        Previous
      </button>
      <button
        disabled={!hasNext}
        className="w-[100px] bg-[royalblue] text-white cursor-pointer p-4 border-[none] disabled:bg-[midnightblue] disabled:cursor-not-allowed;"
        onClick={() => router.push(`?page=${page + 1}`)}>
        Next
      </button>
    </div>
  );
};

export default Pagination;
