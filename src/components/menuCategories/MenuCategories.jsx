import Link from "next/link";
import React from "react";
import styles from "./menuCategories.module.css";

const MenuCategories = () => {
  return (
    <div className={styles.categoryList}>
      <Link
        href="/blog?cat=linux"
        className={`${styles.categoryItem} ${styles.linux}`}>
        Linux
      </Link>
      <Link
        href="/blog?cat=raspi"
        className={`${styles.categoryItem} ${styles.raspi}`}>
        Raspberry Pi
      </Link>
      <Link href="/blog?cat=hacking" className={`${styles.categoryItem} ${styles.hacking}`}>
      Hacking
      </Link>
      <Link href="/blog?cat=server" className={`${styles.categoryItem} ${styles.server}`}>
        Server
      </Link>
      <Link href="/blog?cat=coding" className={`${styles.categoryItem} ${styles.coding}`}>
        Coding
      </Link>
    </div>
  );
};

export default MenuCategories;
