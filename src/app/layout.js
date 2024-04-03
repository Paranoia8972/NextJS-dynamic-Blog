import Navbar from "@/components/Navbar";
import "./globals.css";
import Footer from "@/components/Footer";
import AuthProvider from "@/providers/AuthProvider";
import { Inter } from "next/font/google";

const font = Inter({ subsets: ["latin"], weight: '400' });

export const metadata = {
  title: "Encryptopia Blog",
  description: "My weired knowledge, noted down.",
};

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body className={font.className}>
        <AuthProvider>
          <div className="container">
            <Navbar />
            {children}
            <Footer />
          </div>
        </AuthProvider>
      </body>
    </html>
  );
}
