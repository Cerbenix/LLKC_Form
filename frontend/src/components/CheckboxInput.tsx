import React from "react";

interface CheckboxInputProps {
    children: React.ReactNode
}

const CheckboxInput: React.FC<CheckboxInputProps> = ({children}) => {
    return (
        <div className="flex flex-row pl-2">
            {children}
        </div>
    )
}

export default CheckboxInput