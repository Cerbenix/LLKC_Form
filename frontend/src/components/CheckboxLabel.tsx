import React from "react";

interface CheckboxLabelProps {
  htmlFor?: string;
  children: React.ReactNode;
}

const CheckboxLabel: React.FC<CheckboxLabelProps> = ({ children, htmlFor }) => {
  return (
    <label htmlFor={htmlFor} className="mx-2">
      {children}
    </label>
  );
};

export default CheckboxLabel;
