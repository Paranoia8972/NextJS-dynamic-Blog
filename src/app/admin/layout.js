import Sidebar from '@/components/SideBar';

export default function AdminLayout({ children }) {
  return (
    <>
      <Sidebar />
      <div className="wrapper">{children}</div>
    </>
  );
}