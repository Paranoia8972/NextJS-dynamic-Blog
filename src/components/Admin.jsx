"use client"
import { useEffect } from 'react';
import { useRouter } from 'next/router';
import { useSession } from "next-auth/react";

const Admin = () => {
    const router = useRouter();
    const session = getServerSession(authOptions);
    const { status } = useSession();

    useEffect(() => {
        if (status === 'unauthenticated') {
            router.push('/login');
        } else if (session?.user.role === 'user') {
            router.push('/');
        }
    }, [session, router, status]);

    return <></>;
};

export default Admin;
