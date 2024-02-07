import Link from "next/link";
import { ModeToggle } from "./ModeToggle";

export default function Navbar() {
  return (
    <nav className="w-full relative flex items-center justify-between mx-auto px-4 py-5">
      <Link href="/" className="font-bold text-3xl">
      <span className="text-primary">Encryptopia</span> Blog
      </Link>

      <ModeToggle />
    </nav>
  );
}
