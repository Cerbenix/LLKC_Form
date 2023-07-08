import React, { ChangeEvent } from "react";

interface InputProps {
  type: string;
  name: string;
  value?: string;
  id?: string;
  onChange: (e: ChangeEvent<HTMLInputElement>) => void;
}

const Input: React.FC<InputProps> = ({ type, name, value, id, onChange }) => {
  return (
    <input
      type={type}
      name={name}
      value={value}
      id={id}
      onChange={onChange}
      className="border-gray-400 border-2 px-2 py-1"
    />
  );
};

export default Input;
