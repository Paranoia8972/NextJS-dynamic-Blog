"use client";
import { signIn, useSession } from "next-auth/react";
import { useRouter } from "next/navigation";
import Link from "next/link";
import { FaGithub, FaGoogle } from "react-icons/fa";
import { CiMail } from "react-icons/ci";

const LoginPage = () => {
  const { status } = useSession();

  const router = useRouter();

  if (status === "loading") {
    return <div>Loading...</div>;
  }

  if (status === "authenticated") {
    router.push("/");
  }

  return (
    <div className="flex items-center justify-center mt-[60px]">
      <div className="flex flex-col gap-6 w-96">
        <form>
          <div className="flex justify-between w-full">
            <div className="w-1/2 pr-2">
              <label htmlFor="fname">First name</label>
              <br />
              <input type="text" placeholder="Max" id="fname" name="fname" className="bg-transparent flex items-center justify-center p-5 rounded-[5px] border h-4 w-full" />
            </div>
            <div className="w-1/2 pl-2">
              <label htmlFor="lname">Last name</label>
              <br />
              <input type="text" placeholder="Robinson" id="lname" name="lname" className="bg-transparent flex items-center justify-center p-5 rounded-[5px] border h-4 w-full" />
            </div>
          </div>
          <br />
          <label htmlFor="fname">Email</label>
          <br />
          <input type="email" placeholder="m@example.com" className="bg-transparent flex items-center justify-center p-5 rounded-[5px] border h-4 w-full"></input>
        </form>

        <div className="text-black bg-white hover:bg-white/90 transition-all cursor-pointer flex items-center justify-center p-5 rounded-[5px] border h-4" onClick={() => signIn("bitbucket")}>
          <CiMail />&nbsp;Login with Email
        </div>
        <div className="border-b"></div>
        <div className="text-white bg-black hover:bg-neutral-800 transition-all cursor-pointer flex items-center justify-center p-5 rounded-[5px] border h-4" onClick={() => signIn("github")}>
          <FaGithub />&nbsp;GitHub
        </div>
        <div className="text-white bg-black hover:bg-neutral-800 transition-all cursor-pointer flex items-center justify-center p-5 rounded-[5px] border h-4" onClick={() => signIn("bitbucket")}>
          <FaGoogle />&nbsp;Google
        </div>
        <div className="mt-4 text-center text-sm">
          By clicking continue, you agree to our {/* */}
          <Link className="underline" href="#">
            Terms of Service
          </Link>
          {/* */} and {/* */}
          <Link className="underline" href="#">
            Privacy Policy
          </Link>
          .
        </div>
      </div>
    </div>
  );
};

export default LoginPage;
