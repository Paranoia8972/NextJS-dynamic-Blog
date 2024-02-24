import Menu from "@/components/Menu/Menu";
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
    <div>
      <div>
        <div>
          <h1>AASDF</h1>
        </div>
        {data?.img && (
          <div>
            <Image src={data.img} alt="" fill />
          </div>
        )}
      </div>
      <div>
        <div>
          <div dangerouslySetInnerHTML={{ __html: data?.desc }} />
        </div>
        <Menu />
      </div>
    </div>
  );
};

export default SinglePage;
