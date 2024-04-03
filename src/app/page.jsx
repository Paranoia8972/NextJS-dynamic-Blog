import Link from "next/link";
import CardList from "@/components/CardList";

export default function Home({ searchParams }) {

  const page = parseInt(searchParams.page) || 1;
  return (
    <div>
      <div className="lex gap-[50px]">
        <CardList page={page} />
      </div>
    </div>
  );
}
