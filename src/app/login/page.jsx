"use client";
import { signIn, useSession } from "next-auth/react";
import styles from "./loginPage.module.css";
import { useRouter } from "next/navigation";

const LoginPage = () => {
  const { status } = useSession();

  const router = useRouter();

  if (status === "loading") {
    return <div className={styles.loading}>Loading...</div>;
  }

  if (status === "authenticated") {
    router.push("/");
  }

  return (
    <div className={styles.container}>
      <div className={styles.wrapper}>
        <div className={styles.socialButton} onClick={() => signIn("gitlab")}>
          Sign in with GitLab
        </div>
        <div className={styles.socialButton} onClick={() => signIn("github")}>
          Sign in with GitHub
        </div>
        <div className={styles.socialButton} onClick={() => signIn("bitbucket")}>
          Sign in with BitBucket
        </div>
      </div>
    </div>
  );
};

export default LoginPage;
