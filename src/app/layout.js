import Navbar from "@/components/Navbar";
import "./globals.css";
import Footer from "@/components/Footer";
import AuthProvider from "@/providers/AuthProvider";
import { Inter } from "next/font/google";
import { SpeedInsights } from "@vercel/speed-insights/next"
import { Analytics } from "@vercel/analytics/react"

const font = Inter({
  subsets: ["latin"],
  display: 'swap',
  weight: '400',
  style: 'normal',
  size: '20px',
  lineHeight: '36px',
});

export const metadata = {
  title: "Encryptopia Blog",
  description: "My weired knowledge, noted down.",
};

export default function RootLayout({ children }) {
  return (
    <html lang="en">
      <body className={font.className}>
        <SpeedInsights />
        <Analytics />
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
