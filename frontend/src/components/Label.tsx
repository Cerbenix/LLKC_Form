import React from "react";

interface LabelProps {
  htmlFor?: string;
  children: React.ReactNode;
}

const Label: React.FC<LabelProps> = ({ htmlFor, children }) => {
  return (
    <label htmlFor={htmlFor} className="text-lg">
      {children}
    </label>
  );
};

export default Label;
