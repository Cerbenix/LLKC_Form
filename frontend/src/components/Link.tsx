import React from "react";

interface LinkProps {
  children: React.ReactNode;
  href: string;
}

const Link: React.FC<LinkProps> = ({ children, href }) => {
  return <a href={href} className='hover:text-cyan-500 font-bold mx-5'>{children}</a>;
};

export default Link