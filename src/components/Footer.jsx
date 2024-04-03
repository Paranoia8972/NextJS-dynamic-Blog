"use client"
import React from "react";
import Image from "next/image";
import Link from "next/link";
import { signOut, useSession } from "next-auth/react";

const Footer = () => {
  const { status } = useSession();
  const date = new Date();
  const year = date.getFullYear();
  const scrollToTop = () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };
  return (
    <footer className="border-t mt-24">
      <div className="relative mx-auto max-w-screen-xl px-4 py-16 sm:px-6 lg:px-8 lg:pt-24">
        <div className="absolute end-4 top-4 sm:end-6 sm:top-6 lg:end-8 lg:top-8">
          <Link
            className="inline-block rounded-full bg-blue-600 p-2 text-white shadow transition hover:bg-blue-500 sm:p-3 lg:p-4 hover:scale-105"
            href=""
            onClick={(e) => {
              e.preventDefault();
              scrollToTop();
            }}
          >
            <span className="sr-only">Back to top</span>
            <svg
              xmlns="http://www.w3.org/2000/svg"
              className="h-5 w-5"
              viewBox="0 0 20 20"
              fill="currentColor"
            >
              <path
                fillRule="evenodd"
                d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z"
                clipRule="evenodd"
              />
            </svg>
          </Link>
        </div>

        <div className="lg:flex lg:items-end lg:justify-between">
          <div>
            <div className="flex items-center gap-2.5 lg:justify-start">
              <Image
                src="https://github.com/paranoia8972.png"
                alt="paranoia8972"
                width={50}
                height={50}
                className="rounded-full"
              />
              <h1 className="text-2xl">Encryptopia</h1>
            </div>
            <p className="mx-auto mt-6 max-w-md text-center leading-relaxed text-gray-500 lg:text-left">
              My wierd knowledge, noted down.
            </p>
          </div>
          <ul className="mt-12 flex flex-wrap justify-center gap-6 md:gap-8 lg:mt-0 lg:justify-end lg:gap-12">
            <li>
              <Link className="text-gray-700 transition hover:text-gray-700/75" href="#">
                {status === "unauthenticated" ? (
                  <Link href="/login" className="cursor-pointer">
                    Login
                  </Link>
                ) : (
                  <span className="cursor-pointer" onClick={signOut}>
                    Logout
                  </span>
                )}
              </Link>
            </li>

            <li>
              <Link className="text-gray-700 transition hover:text-gray-700/75" href="/categories">
                Categories
              </Link>
            </li>
            <li>
              <Link className="text-gray-700 transition hover:text-gray-700/75" href="https://encryptopia.dev/dsgvo">
                Privacy Policy
              </Link>
            </li>
            <li>
              <Link className="text-gray-700 transition hover:text-gray-700/75" href="https://encryptopia.dev/impressum">
                Imprint
              </Link>
            </li>
          </ul>
        </div>
        <p className="mt-12 text-center text-sm text-gray-500 lg:text-right">
          Copyright &copy; {year}. All rights reserved.
        </p>
      </div>
    </footer>
  );
};

export default Footer;
