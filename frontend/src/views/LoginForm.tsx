import React, { useState, ChangeEvent, FormEvent } from "react";
import InputFieldContainer from "../components/InputFieldContainer";
import Error from "../components/Error";
import Label from "../components/Label";
import Input from "../components/Input";
import Button from "../components/Button";

const LoginForm: React.FC = () => {
  const [formData, setFormData] = useState({
    email: "",
    password: "",
  });
  const [formErrors, setFormErrors] = useState({
    email: "",
    password: "",
  });

  const handleInputChange = (e: ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const handleSubmit = async (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();

    const isValid = validateForm();

    if (isValid) {
      try {
        const response = await fetch("/api/login", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            email: formData.email,
            password: formData.password,
          }),
        });

        if (response.ok) {
          const { token } = await response.json();

          localStorage.setItem("token", token);
          window.location.href = "/user/table";
        }
      } catch (error) {
        console.error(error);
      }
    }
  };

  const validateForm = () => {
    let isValid = true;

    setFormErrors({ email: "", password: "" });

    if (formData.email.trim() === "") {
      setFormErrors((prevErrors) => ({
        ...prevErrors,
        email: "Email is required",
      }));
      isValid = false;
    }

    if (formData.password.trim() === "") {
      setFormErrors((prevErrors) => ({
        ...prevErrors,
        password: "Password is required",
      }));
      isValid = false;
    }

    return isValid;
  };

  return (
    <div className="flex flex-col items-center my-10">
      <form
        onSubmit={handleSubmit}
        className="flex flex-col justify-center items-center w-1/3 min-w-[300px] p-10 bg-gray-200 border-2 border-gray-500"
      >
        <InputFieldContainer>
          <Label htmlFor="email">Email:</Label>
          <Input
            type="text"
            name="email"
            id="email"
            value={formData.email}
            onChange={handleInputChange}
          />
          {formErrors.email && <Error>{formErrors.email}</Error>}
        </InputFieldContainer>
        <InputFieldContainer>
          <Label htmlFor="password">Password:</Label>
          <Input
            type="password"
            name="password"
            id="password"
            value={formData.password}
            onChange={handleInputChange}
          />
          {formErrors.password && <Error>{formErrors.password}</Error>}
        </InputFieldContainer>
        <Button>Login</Button>
      </form>
    </div>
  );
};

export default LoginForm;
