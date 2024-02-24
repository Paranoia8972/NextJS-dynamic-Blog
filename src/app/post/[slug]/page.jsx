import Image from "next/image";

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
          {data?.img && (
            <Image
              src={data.img}
              alt={data?.title}
              width={900}
              height={450}
              className="mx-auto mt-8 h-[450px] w-[900px] rounded-[15px] border object-cover"
            />
          )}
        </div>
      </div>
      <div className="prose prose-lg prose-blue prose-invert mt-16 flex-[5] prose-li:marker:text-blue-500">
        <div
          className="mb-5 text-xl font-light sm:text-lg"
          dangerouslySetInnerHTML={{ __html: data?.desc }}
        />
      </div>
    </div>
  );
};

export default SinglePage;
