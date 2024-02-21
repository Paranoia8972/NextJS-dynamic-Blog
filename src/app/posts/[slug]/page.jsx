import Image from "next/image";
// import Comments from "@/components/comments/Comments";

const getData = async (slug) => {
  const res = await fetch(`http://localhost:3000/api/posts/${slug}`, {
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

  return (
    <div className="mx-auto mt-8 w-[900px] px-8">
      <div className="flex gap-[50px] items-center">
        <div className="flex-[1]">
          <h1 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl">
            <span className="mt-2 block text-center font-bold leading-8 tracking-tight sm:text-4xl">
              {data?.title}
            </span>
            <span className="block text-center text-base font-semibold uppercase tracking-wide text-primary">
              Jan 25, 2024
            </span>
          </h1>
          {data?.img && (
            <Image
              src={data.img}
              alt={data?.title}
              width={900}
              height={450}
              className="mx-auto mt-8 rounded-[15px] border"
            />
          )}
        </div>
      </div>
      <div className="flex-[5] prose prose-lg prose-blue mt-16 dark:prose-invert prose-a:text-primary prose-li:marker:text-primary">
        <div
          className="text-xl font-light mb-5 sm:text-lg"
          dangerouslySetInnerHTML={{ __html: data?.desc }}
        />
        {/* ######### Comments ######### */}
        {/* <div className={styles.comment}>
            <Comments postSlug={slug} />
          </div> */}
      </div>
    </div>
  );
};

export default SinglePage;
