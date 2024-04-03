"use client"
import { useEffect, useState } from "react";
import { useSession } from "next-auth/react";
import { useRouter } from "next/navigation";
import {
  getStorage,
  ref,
  uploadBytesResumable,
  getDownloadURL,
} from "firebase/storage";
import { app } from "@/utils/firebase";
import { FiUploadCloud } from "react-icons/fi";
import Image from "next/image";
import dynamic from 'next/dynamic';
import "react-quill/dist/quill.bubble.css";
import "react-quill/dist/quill.snow.css";
const ReactQuill = dynamic(() => import('react-quill'), { ssr: false });

const WritePage = () => {
  const { status } = useSession();
  const router = useRouter();

  const [open, setOpen] = useState(false);
  const [file, setFile] = useState(null);
  const [media, setMedia] = useState("");
  const [value, setValue] = useState("");
  const [title, setTitle] = useState("");
  const [catSlug, setCatSlug] = useState("");
  const [titleError, setTitleError] = useState(false);
  const [contentError, setContentError] = useState(false);
  const [imageError, setImageError] = useState(false);

  useEffect(() => {
    const storage = getStorage(app);
    const upload = () => {
      const name = new Date().getTime() + file.name;
      const storageRef = ref(storage, name);

      const uploadTask = uploadBytesResumable(storageRef, file);

      uploadTask.on(
        "state_changed",
        (snapshot) => {
          const progress =
            (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
          console.log("Upload is " + progress + "% done");
          switch (snapshot.state) {
            case "paused":
              console.log("Upload is paused");
              break;
            case "running":
              console.log("Upload is running");
              break;
          }
        },
        (error) => { },
        () => {
          getDownloadURL(uploadTask.snapshot.ref).then((downloadURL) => {
            setMedia(downloadURL);
          });
        }
      );
    };

    file && upload();
  }, [file]);

  if (status === "loading") {
    return <div className="">Loading...</div>;
  }

  if (status === "unauthenticated") {
    router.push("/");
  }

  const slugify = (str) =>
    str
      .toLowerCase()
      .trim()
      .replace(/[^\w\s-]/g, "")
      .replace(/[\s_-]+/g, "-")
      .replace(/^-+|-+$/g, "");

  const handleSubmit = async () => {
    setTitleError(!title.trim());
    setContentError(!value.trim());
    setImageError(!media);

    if (!title.trim() || !value.trim() || !media) {
      return;
    }

    const res = await fetch("/api/posts", {
      method: "POST",
      body: JSON.stringify({
        title,
        desc: value,
        img: media,
        slug: slugify(title),
        catSlug: catSlug || "style",
      }),
    });

    if (res.status === 200) {
      const data = await res.json();
      router.push(`/post/${data.slug}`);
    }
  };

  return (
    <div className="mx-auto mt-8 max-w-[900px] flex items-center gap-[50px] flex-row-reverse">
      <div className="flex-[1]">
        <div className="flex items-center justify-center">
          <h1 className="text-2xl sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl">
            <input
              type="text"
              placeholder="Title"
              className="mt-2 block text-center font-bold leading-8 tracking-tight sm:text-4xl bg-transparent border-[none] outline-none w-[900px]"
              onChange={(e) => setTitle(e.target.value)}
              maxLength={65}
            />
            <span className="block text-center text-base font-semibold uppercase tracking-wide text-blue-500">
              {new Date().toLocaleDateString("en-US", {
                month: "short",
                day: "numeric",
                year: "numeric",
              })}
            </span>
          </h1>
        </div>
        <input
          type="file"
          id="image"
          onChange={(e) => setFile(e.target.files[0])}
          style={{ display: "none" }}
        />
        <div className="mt-8 mb-16">
          <label htmlFor="image" className="hover:cursor-pointer">
            {!media && (
              <div key="1" className="flex h-[450px] w-[900px] flex-col items-center justify-center rounded-[15px] border-2 border-dashed border-[#4F4F4F] text-center p-0">
                <FiUploadCloud className="h-12 w-12 text-[#828282]" />
                <p className="mt-4 text-sm text-[#BDBDBD]">
                  Click to upload
                </p>
              </div>
            )}
            {media && (
              <Image
                src={media}
                alt="Uploaded"
                width={900}
                height={450}
                className="mt-8 h-[450px] w-[900px] rounded-[15px] border object-cover"
              />
            )}
          </label>
        </div>
        <div className="w-[900px] h-[450px]">
          <ReactQuill
            className="rounded-xl w-[900px] h-[450px] prose prose-lg prose-blue prose-invert mb-5 mt-16 text-xl font-light prose-li:marker:text-blue-500 sm:text-lg"
            theme="snow"
            value={value}
            onChange={setValue}
            placeholder="Tell your story..."
          />
        </div>
        <select className="text-white bg-transparent border rounded-lg w-32" onChange={(e) => setCatSlug(e.target.value)}>
          <option value="style">style</option>
          <option value="fashion">fashion</option>
          <option value="food">food</option>
          <option value="culture">culture</option>
          <option value="travel">travel</option>
          <option value="coding">coding</option>
        </select>
        <div className="flex flex-col">
          <button className="px-8 py-2 rounded-full bg-gradient-to-b from-blue-500 to-blue-600 text-white focus:ring-2 focus:ring-blue-400 hover:shadow-xl transition duration-200 w-min" onClick={handleSubmit}>
            Publish
          </button>
          {titleError && <p className="text-red-500 mt-2">A title is required.</p>}
          {imageError && <p className="text-red-500 mt-2">A image is required.</p>}
          {contentError && <p className="text-red-500 mt-2">The content is required.</p>}
        </div>
      </div>
    </div>
  );
};

export default WritePage;