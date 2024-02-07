import React from 'react';

const Footer: React.FC = () => {
  return (
    <footer className="w-full relative flex items-center justify-between mx-auto px-4 py-5">
        <p className="">&copy; {new Date().getFullYear()} Encryptopia</p>
    </footer>
  );
};

export default Footer;