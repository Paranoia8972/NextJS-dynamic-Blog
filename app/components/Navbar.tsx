import Link from "next/link";
import { ModeToggle } from "./ModeToggle";

export default function Navbar() {
  return (
    <nav className="relative mx-auto flex w-full items-center justify-between px-4 py-5">
      <Link href="/" className="text-3xl font-bold">
        <span className="text-blue-500">Encryptopia</span> Blog
      </Link>

      <ModeToggle />
    </nav>
  );
}
