import Image from "next/image";
import Script from "next/script";
import "../../../../public/prism/prism.js";
import "../../../../public/prism/prism.css";
import "../../../../public/prism/prism-duotone-sea.css";
import Comments from "@/components/Comments";

const getData = async (slug) => {
  console.log(process.env.BASE_URL, slug);
  const res = await fetch(`${process.env.BASE_URL}/api/posts/${slug}`, {
    cache: "no-store",
  });
  if (!res.ok) {
    throw new Error("Failed");
  }
  return res.json();
};

const SinglePage = async ({ params }) => {
  const { slug } = params;
  const data = await getData(slug);

  const metadata = {
    title: data?.title,
    description: 'My wierd knowledge, noted down.',
    openGraph: {
      title: data?.title,
      description: 'My wierd knowledge, noted down.',
      images: data.img,
    },
  };
  return (
    <>
      <Script src="/prism/prism.js" />
      <div className="mx-auto mt-8 w-[900px]">
        <div className="flex items-center gap-[50px]">
          <div className="flex-[1]">
            <h1 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl">
              <span className="mt-2 block text-center font-bold leading-8 tracking-tight sm:text-4xl">
                {data?.title}
              </span>
              <span className="block text-center text-base font-semibold uppercase tracking-wide text-blue-500">
                {new Date(data.createdAt).toLocaleDateString("en-US", {
                  month: "short",
                  day: "numeric",
                  year: "numeric",
                })}
              </span>
            </h1>
            <Image
              src={data.img}
              alt={data?.title}
              width={900}
              height={450}
              className="mt-8 h-[450px] w-[900px] rounded-[15px] border object-cover"
            />
          </div>
        </div>
        <div
          className="prose prose-lg prose-blue prose-invert mb-5 mt-16 mx-6 text-xl font-light prose-li:marker:text-blue-500 sm:text-lg text-[#fafafa]"
          dangerouslySetInnerHTML={{ __html: data?.desc }}
        />
        <div className="mx-6">
          <Comments postSlug={slug} />
        </div>
      </div>
    </>
  );
};

export default SinglePage;
