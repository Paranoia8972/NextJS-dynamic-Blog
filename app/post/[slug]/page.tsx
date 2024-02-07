import Image from "next/image";

export const revalidate = 30; // revalidate at most 30 seconds

export default async function BlogArticle()
{
  return (
    <div className="mt-8">
      <h1>
        <span className="block text-base text-center text-primary font-semibold tracking-wide uppercase">
          Jan Marshal - Blog
        </span>
        <span className="mt-2 block text-3xl text-center leading-8 font-bold tracking-tight sm:text-4xl">
        </span>
      </h1>

      <Image
        src="/images/"
        width={800}
        height={800}
        alt="Title Image"
        priority
        className="rounded-lg mt-8 border"
      />

      <div className="mt-16 prose prose-blue prose-lg dark:prose-invert prose-li:marker:text-primary prose-a:text-primary">
      </div>
    </div>
  );
}
