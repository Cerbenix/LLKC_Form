import React, { MouseEvent } from 'react';

interface ButtonProps {
  onClick?: (event: MouseEvent<HTMLButtonElement>) => void;
  children: React.ReactNode
}

const Button: React.FC<ButtonProps> = ({ children, onClick }) => {
  return (
    <button
      className={`border-gray-400 border-2 px-5 py-2 bg-gray-300 hover:text-cyan-500 mt-3`}
      onClick={onClick}
    >
      {children}
    </button>
  );
};

export default Button;
