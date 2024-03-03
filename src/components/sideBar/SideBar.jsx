import React from "react";
import Link from "next/link";

const SideBar = () => {
  return (
    <div className="fixed bottom-0 left-0 min-h-[90vh] w-40 border-r p-4 text-white">
      <h2 className="mb-4 text-2xl">Admin Panel</h2>
      <ul>
        <li className="mb-2">
          <Link className="hover:text-blue-300" href="/admin/posts">
            Posts
          </Link>
        </li>
        <li className="mb-2">
          <Link className="hover:text-blue-300" href="/admin/comments">
            Comments
          </Link>
        </li>
        <li className="mb-2">
          <Link className="hover:text-blue-300" href="/admin/users">
            Users
          </Link>
        </li>
      </ul>
    </div>
  );
};

export default SideBar;
