import Image from "next/image";
import Link from "next/link";

const Card = ({ item }) => {
  return (
    <div className="my-2 flex flex-col">
      <Link href={`/post/${item.slug}`}>
        <Image
          src={item.img}
          alt={item.slug}
          className="h-[200px] w-[400px] cursor-pointer rounded-xl border object-cover"
          width={400}
          height={200}
        />
        <p className="mt-2 cursor-pointer px-4 text-2xl font-bold">
          {item.title}
        </p>
      </Link>
      <p className="mt-[-2px] px-4 text-sm font-light text-gray-400">
        {new Date(item.createdAt).toLocaleDateString("en-US", {
          month: "short",
          day: "numeric",
          year: "numeric",
        })}
      </p>
    </div>
  );
};

export default Card;
