"use client"

import { useEffect } from 'react';
import { useRouter } from 'next/navigation';
import { getServerSession } from "next-auth";
import React from "react";
import { authOptions } from "@/utils/auth";

export default function PostsPage() {
  const router = useRouter();
  const session = getServerSession(authOptions);

  useEffect(() => {
    if (!session || session?.user.role === 'USER') {
      router.push('/');
    }
  }, []);

  return (
    <>
      <h1>Dashboard</h1>
    </>
  );
}