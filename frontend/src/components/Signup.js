import React, { useState } from "react";
import { Link } from "react-router-dom";
import api from "../api/axios";
import "./Signup.css";

const Signup = () => {
  const [form, setForm] = useState({
    first_name: "",
    last_name: "",
    email: "",
    role: "",
    password: "",
    confirm_password: "",
    date_of_birth: "",
  });

  const [errors, setErrors] = useState({});
  const [serverMessage, setServerMessage] = useState("");
  const [success, setSuccess] = useState("");

  const handleChange = (e) => {
    setForm({ ...form, [e.target.name]: e.target.value });
    setErrors({ ...errors, [e.target.name]: "" });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setErrors({});
    setSuccess("");
    setServerMessage("");

    const newErrors = {};

    if (!form.first_name.trim())
      newErrors.first_name = "First name is required";

    if (!form.last_name.trim()) newErrors.last_name = "Last name is required";

    if (!form.role.trim()) newErrors.role = "Role is required";

    if (!form.email.trim()) {
      newErrors.email = "Email is required";
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(form.email)) {
      newErrors.email = "Invalid email format";
    }
    if (!form.password.trim()) newErrors.password = "Password is required";
    if (!form.confirm_password.trim())
      newErrors.confirm_password = "Confirm password is required";
    if (!form.date_of_birth.trim())
      newErrors.date_of_birth = "Date of birth is required";

    if (
      form.password &&
      form.confirm_password &&
      form.password !== form.confirm_password
    ) {
      newErrors.confirm_password = "Passwords do not match";
    }

    // If any frontend errors, stop and display them
    if (Object.keys(newErrors).length > 0) {
      setErrors(newErrors);
      return;
    }

    try {
      const data = new FormData();
      for (let key in form) data.append(key, form[key]);
      console.log("Submitting data:", Object.fromEntries(data.entries()));

      const response = await api.post("/register", data);
      if (response.data.status) {
        setSuccess("Registration successful. Redirecting to login...");
        setForm({
          first_name: "",
          last_name: "",
          email: "",
          role: "",
          password: "",
          confirm_password: "",
          date_of_birth: "",
        });
        setTimeout(() => {
          window.location.href = "/login?registered=1";
        }, 1500);
      } else {
        setServerMessage(response.data.message || "Registration failed.");
      }
    } catch (err) {
      if (err.response?.data?.messages) {
        setErrors(err.response.data.messages);
      } else {
        setServerMessage("Something went wrong.");
      }
    }
  };

  return (
    <div className="signup-wrapper d-flex justify-content-center align-items-center vh-100">
      <div className="signup-box p-4 shadow-lg rounded">
        <h2 className="text-center mb-4">Register</h2>

        {serverMessage && (
          <div className="alert alert-danger">{serverMessage}</div>
        )}
        {success && <div className="alert alert-success">{success}</div>}

        <form onSubmit={handleSubmit} noValidate>
          {[
            {
              name: "first_name",
              label: "First Name",
              type: "text",
              placeholder: "Enter your first name",
            },
            {
              name: "last_name",
              label: "Last Name",
              type: "text",
              placeholder: "Enter your last name",
            },
            {
              name: "email",
              label: "Email",
              type: "email",
              placeholder: "Enter your email",
            },
            {
              name: "role",
              label: "Role",
              type: "select",
              placeholder: "Please select role",
            },
            {
              name: "password",
              label: "Password",
              type: "password",
              placeholder: "Enter your password",
            },
            {
              name: "confirm_password",
              label: "Confirm Password",
              type: "password",
              placeholder: "Re-enter your password",
            },
            {
              name: "date_of_birth",
              label: "Date of Birth",
              type: "date",
              placeholder: "",
            },
          ].map((input) => (
            <div className="form-group mb-3" key={input.name}>
              <label for={input.name}>{input.label}</label>
              {input.type === "select" ? (
                <select
                  name={input.name}
                  className={`form-control ${
                    errors[input.name] ? "is-invalid" : ""
                  }`}
                  value={form[input.name]}
                  onChange={handleChange}
                  required
                >
                  <option value="">Please select role</option>
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
              ) : (
                <input
                  type={input.type}
                  name={input.name}
                  className={`form-control ${
                    errors[input.name] ? "is-invalid" : ""
                  }`}
                  placeholder={input.placeholder}
                  value={form[input.name]}
                  onChange={handleChange}
                  required
                />
              )}
              {errors[input.name] && (
                <div className="invalid-feedback">{errors[input.name]}</div>
              )}
            </div>
          ))}

          <button type="submit" className="btn btn-success w-100">
            Register
          </button>
        </form>

        <div className="text-center mt-3">
          <span>Already have an account? </span>
          <Link to="/login">Login</Link>
        </div>
      </div>
    </div>
  );
};

export default Signup;
