import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import "./Login.css";
import api from "../api/axios";

const Login = () => {
  const [form, setForm] = useState({ email: "", password: "" });
  const [errors, setErrors] = useState({});
  const [serverMessage, setServerMessage] = useState("");
  const navigate = useNavigate();

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
    setErrors({ ...errors, [e.target.name]: "" });
    setServerMessage("");
  };

  const validateForm = () => {
    const newErrors = {};

    if (!form.email.trim()) {
      newErrors.email = "Email is required";
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) {
      newErrors.email = "Invalid email format";
    }

    if (!form.password.trim()) {
      newErrors.password = "Password is required";
    }

    return newErrors;
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrors({});
    setServerMessage("");

    const validationErrors = validateForm();
    if (Object.keys(validationErrors).length > 0) {
      setErrors(validationErrors);
      return;
    }

    const data = new FormData();
    data.append("email", form.email);
    data.append("password", form.password);

    try {
      const response = await api.post("/login", data);

      // Assuming API returns { status: 200, data: { token: '...' } }
      if (response.data.status === 200 && response.data.data?.token) {
        localStorage.setItem("token", response.data.data.token);
        navigate("/dashboard");
      } else {
        setServerMessage(response.data.message || "Invalid login credentials.");
      }
    } catch (error) {
      const apiMessage =
        error.response?.data?.message ||
        "Something went wrong. Please try again.";
      setServerMessage(apiMessage);
    }
  };

  return (
    <div className="login-wrapper d-flex justify-content-center align-items-center vh-100">
      <div className="login-box p-4 shadow-lg rounded">
        <h2 className="text-center mb-4">Login</h2>

        {serverMessage && (
          <div className="alert alert-danger">{serverMessage}</div>
        )}

        <form onSubmit={handleSubmit} noValidate>
          {/* Email */}
          <div className="form-group mb-3">
            <label>Email</label>
            <input
              type="email"
              name="email"
              placeholder="Enter email"
              value={form.email}
              onChange={handleChange}
              className={`form-control ${errors.email ? "is-invalid" : ""}`}
            />
            {errors.email && (
              <div className="invalid-feedback">{errors.email}</div>
            )}
          </div>

          {/* Password */}
          <div className="form-group mb-3">
            <label>Password</label>
            <input
              type="password"
              name="password"
              placeholder="Enter password"
              value={form.password}
              onChange={handleChange}
              className={`form-control ${errors.password ? "is-invalid" : ""}`}
            />
            {errors.password && (
              <div className="invalid-feedback">{errors.password}</div>
            )}
          </div>

          <button type="submit" className="btn btn-primary w-100">
            Login
          </button>
        </form>

        <div className="text-center mt-3">
          <span>Don't have an account? </span>
          <Link to="/signup">Register</Link>
        </div>
      </div>
    </div>
  );
};

export default Login;
