import Navbar from "@/components/Navbar";
import "./globals.css";
import Footer from "@/components/Footer";
import AuthProvider from "@/providers/AuthProvider";
import { Inter } from "next/font/google";

const font = Inter({
  subsets: ["latin"],
  display: 'swap',
  weight: '400',
  style: 'normal',
  size: '20px',
  lineHeight: '36px',
});

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body className={font.className}>
        <div className="container">
          <Navbar />
          {children}
          <Footer />
        </div>
      </body>
    </html>
  );
}
