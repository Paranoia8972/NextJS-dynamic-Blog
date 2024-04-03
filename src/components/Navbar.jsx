import React from "react";
import Link from "next/link";
import AuthLinks from "./AuthLinks";

const Navbar = () => {
  return (
    <div className="flex items-center justify-between h-[100px]">
      <Link href="/" className="flex-1 text-start text-4xl font-bold xl:text-[32px] lg:text-left md:text-2xl">
        Encryptopia
      </Link>
      <div className="flex gap-5 flex-1 text-xl justify-end">
        <AuthLinks />
      </div>
    </div>
  );
};

export default Navbar;
