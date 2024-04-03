"use client";
import Link from "next/link";
import { signOut, useSession } from "next-auth/react";

const AuthLinks = () => {
  const { status } = useSession();
  return (
    <>
      {status === "unauthenticated" ? (
        <Link href="/login" className="cursor-pointer">
          Login
        </Link>
      ) : (
        <span className="cursor-pointer" onClick={signOut}>
          Logout
        </span>
      )}
    </>
  );
};

export default AuthLinks;
