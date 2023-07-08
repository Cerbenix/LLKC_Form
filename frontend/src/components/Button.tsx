import React, { MouseEvent } from 'react';

interface ButtonProps {
  onClick?: (event: MouseEvent<HTMLButtonElement>) => void;
  children: React.ReactNode
}

const Button: React.FC<ButtonProps> = ({ children, onClick }) => {
  return (
    <button
      className={`border-gray-400 border-2 px-7 py-4 bg-slate-400 hover:bg-slate-500 hover:text-white mt-3 rounded-lg`}
      onClick={onClick}
    >
      {children}
    </button>
  );
};

export default Button;
