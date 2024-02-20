import Image from "next/image";
import styles from "./card.module.css";
import Link from "next/link";

const Card = ({ key, item }) => {
  return (
    <div className="my-2 flex flex-col">
      <a href={`/posts/${item.slug}`}>
        <Image
          src={item.img}
          alt={item.slug}
          className="border h-[200px] w-[400px] cursor-pointer rounded-xl object-cover"
          width={400}
          height={200}
        />
        <p className="mt-2 cursor-pointer px-4 text-2xl font-bold">
          {item.title}
        </p>
      </a>
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
