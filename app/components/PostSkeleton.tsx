import { Skeleton } from "@/components/ui/skeleton";

export function PostSkeleton() {
  return (
    <div className="my-2 flex flex-col space-y-3">
      <Skeleton className="h-[200px] w-[400px] rounded-xl" />
      <div className="space-y-2">
        <Skeleton className="h-6 w-[300px] px-4" />
        <Skeleton className="h-4 w-[200px] px-4" />
      </div>
    </div>
  );
}
