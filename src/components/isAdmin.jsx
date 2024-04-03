import { useSession } from "next-auth/react"
import Link from "next/link";
import { signOut, useSession } from "next-auth/react";
const isAdmin = async () => {

    const session = await useSession()

    if (session?.user.role === "admin") {
        return <p>You are an admin, welcome!</p>
    }

    return <p>You are not authorized to view this page!</p>
}
export default isAdmin;