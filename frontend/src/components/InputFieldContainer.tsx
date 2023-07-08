import React from 'react';

interface InputFieldContainerProps {
  children: React.ReactNode;
}

const InputFieldContainer: React.FC<InputFieldContainerProps> = ({ children }) => {
  return (
    <div className='flex flex-col p-1 w-full'>
      {children}
    </div>
  );
};

export default InputFieldContainer;