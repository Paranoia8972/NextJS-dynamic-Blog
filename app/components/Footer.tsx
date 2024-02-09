import React from "react";

const Footer: React.FC = () => {
  return (
    <footer className="relative mx-auto flex w-full items-center justify-between px-4 py-5">
      <p className="">&copy; {new Date().getFullYear()} Encryptopia</p>
    </footer>
  );
};

export default Footer;
