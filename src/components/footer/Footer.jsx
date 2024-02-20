import React from "react";
import styles from "./footer.module.css";
import Image from "next/image";
import Link from "next/link";

const Footer = () => {
  return (
    <div className={styles.container}>
      <div className={styles.info}>
        <div className={styles.logo}>
          <Image src="/logo.png" alt="lama blog" width={50} height={50} />
          <h1 className={styles.logoText}>Encryptopia Blog</h1>
        </div>
        <p className={styles.desc}>My wired knowledge, noted down.</p>
      </div>
      <div className={styles.links}>
        <div className={styles.list}>
          <span className={styles.listTitle}>Links</span>
          <Link href="https://encryptopia.dev">Homepage</Link>
          <Link href="/">About</Link>
          <Link href="/">Contact</Link>
        </div>
        <div className={styles.list}>
          <span className={styles.listTitle}>Tags</span>
          <Link href="/cat?=raspi">Raspberry Pi</Link>
          <Link href="/cat?=linux">Linux</Link>
          <Link href="/cat?=hacking">Hacking</Link>
          <Link href="/cat?=server">Server</Link>
          <Link href="/cat?=coding">Coding</Link>
        </div>
        <div className={styles.list}>
          <span className={styles.listTitle}>Social</span>
          <Link href="https://github.com/Paranoia8972">GitHub</Link>
          <Link href="https://twitter.com/@paranoia8972">Twitter</Link>
        </div>
      </div>
    </div>
  );
};

export default Footer;
