"use client";
import { signIn, useSession } from "next-auth/react";
// import { useSearchParams } from "next/navigation";
import Link from "next/link";
import { FaGithub, FaGoogle } from "react-icons/fa";

const LoginPage = () => {
  const { status } = useSession();
  // const searchParams = useSearchParams()
  // const error = searchParams.get('error') || '';

  // let errorMessage = '';
  // switch (error) {
  //   case 'Configuration':
  //     errorMessage = 'There is a problem with the server configuration. Check the server logs for more information.';
  //     break;
  //   case 'AccessDenied':
  //     errorMessage = 'You do not have permission to sign in.';
  //     break;
  //   case 'Verification':
  //     errorMessage = 'The sign in link is no longer valid. It may have been used already or it may have expired.';
  //     break;
  //   case 'Default':
  //     errorMessage = 'An unknown error occurred.';
  // }

  if (status === "authenticated") {
    router.push("/");
  }

  return (
    <div className="flex items-center justify-center h-[47rem]">
      <div className="flex flex-col gap-6 w-96">
        {/* {errorMessage && <p className="text-red-500">{errorMessage}</p>} */}
        <h1 className="font-bold text-3xl text-center">Login</h1>
        <p className="text-gray-300/75 text-center -mt-4">Choose one of the OAuth providers below</p>
        <div className="text-white bg-transparent hover:bg-slate-900 transition-all cursor-pointer flex items-center justify-center p-5 rounded-[5px] border h-4" onClick={() => signIn("github")}>
          <FaGithub />&nbsp;GitHub
        </div>
        <div className="text-white bg-transparent hover:bg-slate-900 transition-all cursor-pointer flex items-center justify-center p-5 rounded-[5px] border h-4" onClick={() => signIn("bitbucket")}>
          <FaGoogle />&nbsp;Google
        </div>
        <div className="mt-2 px-4 text-center text-sm">
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