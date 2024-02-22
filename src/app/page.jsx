import Head from "next/head";
import styles from "./homepage.module.css";
import CardList from "@/components/cardList/CardList";

export default function Home({ searchParams }) {
  const page = parseInt(searchParams.page) || 1;
  const pageTitle = "Home Page Title";
  const pageDescription = "This is the description for the home page.";
  const pageImage = "https://yourwebsite.com/path/to/home-page-image.jpg";

  return (
    <>
      <Head>
        <title>{pageTitle}</title>
        <meta property="og:type" content="website" />
        <meta property="og:title" content="Encryptopia Blog" />
        <meta
          property="og:description"
          content="My wired knowledge, noted down."
        />
        <meta property="og:url" content="https://blog.encryptopia.dev" />
        <meta property="og:image" content="opengraph-image.png" />
        <meta property="og:image:alt" content="Encryptopia Blog" />

        <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:site" content="@paranoia8972" />
        <meta name="twitter:creator" content="@paranoia8972" />
        <meta name="twitter:title" content="Encryptopia Blog" />
        <meta
          name="twitter:description"
          content="My wired knowledge, noted down."
        />
        <meta name="twitter:image" content="twitter-image.png" />
        <meta name="twitter:image:alt" content="Encryptopia Blog" />
      </Head>
      <div>
        <div className="flex gap-[50px]">
          <CardList page={page} />
        </div>
      </div>
    </>
  );
}
