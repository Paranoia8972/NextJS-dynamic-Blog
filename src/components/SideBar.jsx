import React from "react";
import Link from "next/link";

const SideBar = () => {
  return (
    <div className="flex flex-1 overflow-hidden">
      <nav className="w-64 bg-gray-800 text-white p-4 space-y-2 overflow-y-auto">
        <Link className="block py-2 px-3 rounded hover:bg-gray-700" href="#">
          Home
        </Link>
        <Link className="block py-2 px-3 rounded hover:bg-gray-700" href="#">
          Analytics
        </Link>
        <Link className="block py-2 px-3 rounded hover:bg-gray-700" href="#">
          Settings
        </Link>
        <Link className="block py-2 px-3 rounded hover:bg-gray-700" href="#">
          Logout
        </Link>
      </nav>
      <main className="flex-1 p-4 overflow-y-auto" />
    </div>
  );
};

export default SideBar;
