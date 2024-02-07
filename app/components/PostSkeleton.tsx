import { Skeleton } from "@/components/ui/skeleton"

export function PostSkeleton() {
  return (
    <div className="flex flex-col space-y-3 my-2">
      <Skeleton className="h-[200px] w-[400px] rounded-xl" />
      <div className="space-y-2">
        <Skeleton className="h-6 px-4 w-[300px]" />
        <Skeleton className="h-4 px-4 w-[200px]" />
      </div>
    </div>
  )
}