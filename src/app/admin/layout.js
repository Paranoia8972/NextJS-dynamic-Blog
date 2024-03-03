import { Inter } from "next/font/google";
import Sidebar from "@/components/sideBar/SideBar";

const inter = Inter({ subsets: ["latin"] });

export default function AdminLayout({ children }) {
  return (
    <>
      <Sidebar />
      <div className="wrapper">{children}</div>
    </>
  );
}
