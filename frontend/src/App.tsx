import React, { useState } from "react";
import { BrowserRouter as Router, Routes, Route, Navigate } from "react-router-dom";
import Home from "./views/Home";
import Header from "./components/Header";
import RegistrationForm from "./views/RegistrationForm";
import LoginForm from "./views/LoginForm";
import './index.css'
import UserTable from "./views/UserTable";

const App: React.FC = () => {
  const [isAuthenticated, setIsAuthenticated] = useState(!!localStorage.getItem("token"));

  const handleLogout = () => {
    setIsAuthenticated(false);
  };

  return (
    <Router>
      <Header isAuthenticated={isAuthenticated} onLogout={handleLogout} />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/user/register" element={<RegistrationForm />} />
        <Route path="/user/login" element={<LoginForm />} />
        <Route
          path="/user/table"
          element={isAuthenticated ? <UserTable /> : <Navigate to="/user/login" />}
        />
      </Routes>
    </Router>
  );
};

export default App;
