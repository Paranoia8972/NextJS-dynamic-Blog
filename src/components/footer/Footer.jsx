import React from "react";
import styles from "./footer.module.css";
import Image from "next/image";
import Link from "next/link";

const Footer = () => {
  return (
    <div className="flex items-center justify-between text-[color:var(--softTextColor)] mt-[50px] px-0 py-5 border-t">
      <div className={styles.info}>
        <div className={styles.logo}>
          <Image
            src="https://github.com/paranoia8972.png"
            alt="paranoia8972"
            width={50}
            height={50}
            className="rounded-full"
          />
          <h1 className={styles.logoText}>Encryptopia</h1>
        </div>
        <p className={styles.desc}>My wierd knowledge, noted down.</p>
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
          <Link href="/cat?=linux">Linux</Link>
          <Link href="/cat?=server">Server</Link>
          <Link href="/cat?=coding">Coding</Link>
          <Link href="/cat?=hacking">Hacking</Link>
          <Link href="/cat?=raspi">Raspberry Pi</Link>
        </div>
        <div className={styles.list}>
          <span className={styles.listTitle}>Social</span>
          <Link href="https://github.com/Paranoia8972">GitHub</Link>
          <Link href="https://twitter.com/@Paranoia8972">Twitter</Link>
        </div>
      </div>
    </div>
  );
};

export default Footer;
