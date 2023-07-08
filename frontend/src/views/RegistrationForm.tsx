import React, { useState, ChangeEvent, FormEvent, useEffect } from "react";
import DatePicker from "react-datepicker";
import "react-datepicker/dist/react-datepicker.css";
import InputFieldContainer from "../components/InputFieldContainer";
import Label from "../components/Label";
import Input from "../components/Input";
import Button from "../components/Button";
import CheckboxInput from "../components/CheckboxInput";
import CheckboxLabel from "../components/CheckboxLabel";
import Error from "../components/Error";

interface FormData {
  name: string;
  surname: string;
  email: string;
  password: string;
  address: string;
  city: string;
  postalCode: string;
  phone: string;
  comments: string;
  smoking: string;
  hobbies: string[];
  employmentDuration: {
    from: Date | null;
    to: Date | null;
  };
}

interface FormErrors {
  [key: string]: string;
}

const RegistrationForm: React.FC = () => {
  const [registeredEmails, setRegisteredEmails] = useState<string[]>([]);
  const [formErrors, setFormErrors] = useState<FormErrors>({});
  const [formData, setFormData] = useState<FormData>({
    name: "",
    surname: "",
    email: "",
    password: "",
    address: "",
    city: "",
    postalCode: "",
    phone: "",
    comments: "",
    smoking: "",
    hobbies: [],
    employmentDuration: {
      from: null,
      to: null,
    },
  });

  const handleInputChange = (e: ChangeEvent<HTMLInputElement>) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const handleCheckboxChange = (e: ChangeEvent<HTMLInputElement>) => {
    const { name, checked } = e.target;
    if (checked) {
      setFormData((prevData) => ({
        ...prevData,
        hobbies: [...prevData.hobbies, name],
      }));
    } else {
      setFormData((prevData) => ({
        ...prevData,
        hobbies: prevData.hobbies.filter((hobby) => hobby !== name),
      }));
    }
  };

  const handleDateChange = (
    name: keyof (typeof formData)["employmentDuration"],
    date: Date | null
  ) => {
    setFormData((prevData) => ({
      ...prevData,
      employmentDuration: {
        ...prevData.employmentDuration,
        [name]: date,
      },
    }));
  };

  const handleSubmit = async (e: FormEvent<HTMLFormElement>) => {
    e.preventDefault();
  
    console.log(formData)
    const isValid = validateForm();
  
    if (isValid) {
      try {
        const response = await fetch("/api/user/store", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(formData),
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

  // useEffect(() => {
  //   const fetchRegisteredEmails = async (): Promise<void> => {
  //     try {
  //       const response = await fetch("/api/user/index");
  //       if (response.ok) {
  //         const data = await response.json();
  //         const registeredEmails: string[] = data.users.map((user: any) => user.email);
  //         setRegisteredEmails(registeredEmails);
  //       } else {
  //         console.error("Error occurred while fetching registered emails");
  //       }
  //     } catch (error) {
  //       console.error("Error occurred while fetching registered emails", error);
  //     }
  //   };

  //   fetchRegisteredEmails();
  // }, []); 
  

  const validateForm = () => {
    
    const errors: FormErrors = {};

    if (formData.name.trim() === "") {
      errors.name = "Name is required";
    }

    if (formData.surname.trim() === "") {
      errors.surname = "Surname is required";
    }

    if (formData.email.trim() === "") {
      errors.email = "Email is required";
    } else if (!/^\S+@\S+\.\S+$/.test(formData.email)) {
      errors.email = "Email is invalid";
    } else if (registeredEmails.includes(formData.email)) {
      errors.email = 'Email already in use'
    }

    if (formData.password.trim() === "") {
      errors.password = "Password is required";
    } else if (formData.password.length < 6) {
      errors.password = "Password must be at least 6 characters long";
    }

    if (!formData.address.trim()) {
      errors.address = "Address is required";
    }

    if (!formData.city.trim()) {
      errors.city = "City/County is required";
    }

    if (!formData.postalCode.trim()) {
      errors.postalCode = "Postal Code is required";
    }

    if (!formData.phone.trim()) {
      errors.phone = "Phone Number is required";
    } else if (!/^\d+$/.test(formData.phone)) {
      errors.phone = "Phone Number must be only numbers";
    }

    if (!formData.comments.trim()) {
      errors.comments = "Comments are required";
    }

    if (!formData.smoking) {
      errors.smoking = "Please select an option";
    }

    if (formData.hobbies.length === 0) {
      errors.hobbies = "Please select at least one hobby";
    }

    if (!formData.employmentDuration.from || !formData.employmentDuration.to) {
      errors.employmentDuration = "Please select both From and To dates";
    }

    setFormErrors(errors);

    return Object.keys(errors).length === 0;
  };

  return (
    <div className="flex flex-col items-center my-10">
      <form
        onSubmit={handleSubmit}
        className="flex flex-col justify-center items-center w-1/3 min-w-[300px] p-10 bg-gray-200 border-2 border-gray-500"
      >
        <InputFieldContainer>
          <Label htmlFor="name">Name*</Label>
          <Input
            type="text"
            name="name"
            id="name"
            value={formData.name}
            onChange={handleInputChange}
          />
          {formErrors.name && <Error>{formErrors.name}</Error>}
        </InputFieldContainer>

        <InputFieldContainer>
          <Label htmlFor="surname">Surname*</Label>
          <Input
            type="text"
            name="surname"
            id="surname"
            value={formData.surname}
            onChange={handleInputChange}
          />
          {formErrors.surname && <Error>{formErrors.surname}</Error>}
        </InputFieldContainer>

        <InputFieldContainer>
          <Label htmlFor="email">Email*</Label>
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
          <Label htmlFor="password">Password*</Label>
          <Input
            type="password"
            name="password"
            id="password"
            value={formData.password}
            onChange={handleInputChange}
          />
          {formErrors.password && <Error>{formErrors.password}</Error>}
        </InputFieldContainer>

        <InputFieldContainer>
          <Label htmlFor="address">Address*</Label>
          <Input
            type="text"
            name="address"
            id="address"
            value={formData.address}
            onChange={handleInputChange}
          />
          {formErrors.address && <Error>{formErrors.address}</Error>}
        </InputFieldContainer>

        <InputFieldContainer>
          <Label htmlFor="city">City/County*</Label>
          <Input
            type="text"
            name="city"
            id="city"
            value={formData.city}
            onChange={handleInputChange}
          />
          {formErrors.city && <Error>{formErrors.city}</Error>}
        </InputFieldContainer>

        <InputFieldContainer>
          <Label htmlFor="postalCode">Postal Code*</Label>
          <Input
            type="text"
            name="postalCode"
            id="postalCode"
            value={formData.postalCode}
            onChange={handleInputChange}
          />
          {formErrors.postalCode && <Error>{formErrors.postalCode}</Error>}
        </InputFieldContainer>

        <InputFieldContainer>
          <Label htmlFor="phone">Phone Number*</Label>
          <Input
            type="text"
            name="phone"
            id="phone"
            value={formData.phone}
            onChange={handleInputChange}
          />
          {formErrors.phone && <Error>{formErrors.phone}</Error>}
        </InputFieldContainer>

        <InputFieldContainer>
          <Label htmlFor="comments">Comments*</Label>
          <Input
            type="text"
            name="comments"
            id="comments"
            value={formData.comments}
            onChange={handleInputChange}
          />
          {formErrors.comments && <Error>{formErrors.comments}</Error>}
        </InputFieldContainer>

        <InputFieldContainer>
          <Label>Do you smoke?*</Label>
          <div>
            <input
              type="radio"
              name="smoking"
              value="Yes"
              id="smoking-yes"
              onChange={handleInputChange}
              className="mx-1"
            />
            <Label htmlFor="smoking-yes">Yes</Label>
            <input
              type="radio"
              name="smoking"
              value="No"
              id="smoking-no"
              onChange={handleInputChange}
              className="ml-2 mr-1"
            />
            <Label htmlFor="smoking-no">No</Label>
          </div>
          {formErrors.smoking && <Error>{formErrors.smoking}</Error>}
        </InputFieldContainer>

        <InputFieldContainer>
          <Label htmlFor="hobbies">Hobbies*</Label>
          <div className="flex flex-col ">
            <CheckboxInput>
              <input
                type="checkbox"
                name="cycling"
                id="hobby-cycling"
                onChange={handleCheckboxChange}
              />
              <CheckboxLabel htmlFor="hobby-cycling">Cycling</CheckboxLabel>
            </CheckboxInput>

            <CheckboxInput>
              <input
                type="checkbox"
                name="swimming"
                id="hobby-swimming"
                onChange={handleCheckboxChange}
              />
              <CheckboxLabel htmlFor="hobby-swimming">Swimming</CheckboxLabel>
            </CheckboxInput>

            <CheckboxInput>
              <input
                type="checkbox"
                name="rowing"
                id="hobby-rowing"
                onChange={handleCheckboxChange}
              />
              <CheckboxLabel htmlFor="hobby-rowing">Rowing</CheckboxLabel>
            </CheckboxInput>

            <CheckboxInput>
              <input
                type="checkbox"
                name="basketball"
                id="hobby-basketball"
                onChange={handleCheckboxChange}
              />
              <CheckboxLabel htmlFor="hobby-basketball">
                Basketball
              </CheckboxLabel>
            </CheckboxInput>

            <CheckboxInput>
              <input
                type="checkbox"
                name="football"
                id="hobby-football"
                onChange={handleCheckboxChange}
              />
              <CheckboxLabel htmlFor="hobby-football">Football</CheckboxLabel>
            </CheckboxInput>
          </div>
          {formErrors.hobbies && <Error>{formErrors.hobbies}</Error>}
        </InputFieldContainer>

        <InputFieldContainer>
          <Label>How long was your last employment?*</Label>
          <div className="flex flex-col">
            <DatePicker
              selected={formData.employmentDuration.from}
              onChange={(date) => handleDateChange("from", date)}
              selectsStart
              startDate={formData.employmentDuration.from}
              endDate={formData.employmentDuration.to}
              dateFormat="dd/MM/yyyy"
              placeholderText="From"
              className="border-gray-400 border-2 px-5 py-2 my-2"
            />
            <DatePicker
              selected={formData.employmentDuration.to}
              onChange={(date) => handleDateChange("to", date)}
              selectsEnd
              startDate={formData.employmentDuration.from}
              endDate={formData.employmentDuration.to}
              dateFormat="dd/MM/yyyy"
              placeholderText="To"
              className="border-gray-400 border-2 px-5 py-2 my-2"
            />
          </div>
          {formErrors.employmentDuration && (
            <Error>{formErrors.employmentDuration}</Error>
          )}
        </InputFieldContainer>

        <Button>Submit</Button>
      </form>
    </div>
  );
};

export default RegistrationForm;
