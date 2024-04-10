import Link from "next/link";
import CardList from "@/components/CardList";

export const metadata = {
  title: 'Encryptopia Blog',
  description: 'My wierd knowledge, noted down.',
  openGraph: {
    title: 'Encryptopia Blog',
    description: 'My wierd knowledge, noted down.',
    images: ['/og-image.jpg'],
  },
}
export default async function Home({ searchParams }) {
  const page = parseInt(searchParams.page) || 1;
  return (
    <div>
      <div className="lex gap-[50px]">
        <CardList page={page} />
      </div>
    </div>
  );
}
