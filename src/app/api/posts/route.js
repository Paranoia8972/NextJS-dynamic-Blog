import { getAuthSession } from "@/utils/auth";
import prisma from "@/utils/connect";
import { NextResponse } from "next/server";

export const GET = async (req) => {
  const { searchParams } = new URL(req.url);

  const page = searchParams.get("page");
  const cat = searchParams.get("cat");
  const perPage = searchParams.get("perPage");

  const POST_PER_PAGE = perPage ? parseInt(perPage, 10) : 9;

  const query = {
    take: POST_PER_PAGE,
    skip: perPage ? POST_PER_PAGE * (page - 1) : 0,
    where: {
      ...(cat && { catSlug: cat }),
    },
  };

  try {
    const [posts, count] = await prisma.$transaction([
      prisma.post.findMany(query),
      prisma.post.count({ where: query.where }),
    ]);
    return new NextResponse(JSON.stringify({ posts, count }, { status: 200 }));
  } catch (err) {
    console.log(err);
    return new NextResponse(
      JSON.stringify({ message: "Something went wrong!" }, { status: 500 }),
    );
  }
};

// CREATE A POST
export const POST = async (req) => {
  const session = await getAuthSession();

  if (!session) {
    return new NextResponse(
      JSON.stringify({ message: "Not Authenticated!" }, { status: 401 }),
    );
  }

  try {
    const body = await req.json();
    const post = await prisma.post.create({
      data: { ...body, userEmail: session.user.email },
    });

    return new NextResponse(JSON.stringify(post, { status: 200 }));
  } catch (err) {
    console.log(err);
    return new NextResponse(
      JSON.stringify({ message: "Something went wrong!" }, { status: 500 }),
    );
  }
};

// UPDATE A POST
export const PUT = async (req) => {
  const session = await getAuthSession();

  if (!session) {
    return new NextResponse(
      JSON.stringify({ message: "Not Authenticated!" }, { status: 401 }),
    );
  }

  try {
    const { id } = req.query;
    const body = await req.json();
    const updatedPost = await prisma.post.update({
      where: { id: parseInt(id, 10) },
      data: body,
    });

    return new NextResponse(JSON.stringify(updatedPost, { status: 200 }));
  } catch (err) {
    console.log(err);
    return new NextResponse(
      JSON.stringify({ message: "Something went wrong!" }, { status: 500 }),
    );
  }
};

// DELETE A POST
export const DELETE = async (req) => {
  const session = await getAuthSession();

  if (!session) {
    return new NextResponse(
      JSON.stringify({ message: "Not Authenticated!" }, { status: 401 }),
    );
  }

  try {
    const { id } = req.query;
    const deletedPost = await prisma.post.delete({
      where: { id: parseInt(id, 10) },
    });

    return new NextResponse(JSON.stringify(deletedPost, { status: 200 }));
  } catch (err) {
    console.log(err);
    return new NextResponse(
      JSON.stringify({ message: "Something went wrong!" }, { status: 500 }),
    );
  }
};
