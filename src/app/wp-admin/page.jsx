"use client";

import React, { useEffect } from "react";
import Head from "next/head";

const WPAdmin = () => {
  useEffect(() => {
    window.location.href = "https://www.youtube.com/watch?v=dQw4w9WgXcQ";
  }, []);

  return (
    <Head>
      <title>Log In &lsaquo; &#8212; WordPress</title>
      <meta name="description" content="Log In to WordPress Admin" />
      <meta property="og:title" content="Log In ‹ — WordPress" />
      <meta property="og:description" content="Log In to WordPress Admin" />
    </Head>
  );
};

export default WPAdmin;
