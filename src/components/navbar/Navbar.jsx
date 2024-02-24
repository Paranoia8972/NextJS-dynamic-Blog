import React from "react";
import Link from "next/link";
import AuthLinks from "../authLinks/AuthLinks";

const Navbar = () => {
  return (
    <div className="flex items-center justify-between h-[100px]">
      <a href="/" className="flex-1 text-start text-4xl font-bold xl:text-[32px] lg:text-left md:text-2xl">
          Encryptopia
      </a>
      <div className="flex gap-5 flex-1 text-xl justify-end">
        <Link href="/">Contact</Link>
        <Link href="/">About</Link>
        <AuthLinks />
      </div>
    </div>
  );
};

export default Navbar;
