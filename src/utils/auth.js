import { PrismaAdapter } from "@auth/prisma-adapter";
import GithubProvider from "next-auth/providers/github";
import GoogleProvider from "next-auth/providers/google";
import AtlassianProvider from "next-auth/providers/atlassian"
import NextAuth from "next-auth/next";
import GitlabProvider from "next-auth/providers/gitlab";
import prisma from "./connect";
import { getServerSession } from "next-auth";
import EmailProvider from "next-auth/providers/email"

export const authOptions = {
  session: {
    strategy: "jwt",
  },
  adapter: PrismaAdapter(prisma),
  providers: [
    GithubProvider({
      clientId: process.env.GITHUB_ID,
      clientSecret: process.env.GITHUB_SECRET,
    }),
    GoogleProvider({
      clientId: process.env.GOOGLE_ID,
      clientSecret: process.env.GOOGLE_SECRET
    }),
    EmailProvider({
      server: {
        host: process.env.EMAIL_SERVER_HOST,
        port: process.env.EMAIL_SERVER_PORT,
        auth: {
          user: process.env.EMAIL_SERVER_USER,
          pass: process.env.EMAIL_SERVER_PASSWORD
        }
      },
      from: process.env.EMAIL_FROM
    }),
  ],
  callbacks: {
    async jwt({ token, user }) {
      return { ...token, ...user };
    },
    async session({ session, token }) {
      session.user.Role = token.Role;
      return session;
    },
  },
};

const handler = NextAuth(authOptions);

export { handler as GET, handler as POST };

export const getAuthSession = () => getServerSession(authOptions);
