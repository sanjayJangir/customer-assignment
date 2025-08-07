// Dashboard.js
import React, { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import { jwtDecode } from "jwt-decode";
import api from "../api/axios";
import "./Dashboard.css";

const Dashboard = () => {
  const navigate = useNavigate();
  const [user, setUser] = useState(null);
  const [users, setUsers] = useState([]);

  useEffect(() => {
    const token = localStorage.getItem("token");
    if (!token) return navigate("/login");

    try {
      const decoded = jwtDecode(token);

      setUser(decoded);
      fetchUsers(token);
    } catch {
      localStorage.removeItem("token");
      navigate("/login");
    }
  }, [navigate]);

  const fetchUsers = async (token) => {
    try {
      const response = await api.get("/users");
      setUsers(response.data.data || []);
    } catch (err) {
      console.error("Error fetching users:", err);
    }
  };

  const handleLogout = () => {
    localStorage.removeItem("token");
    navigate("/login");
  };

  const handleDelete = async (id) => {
    const confirmed = window.confirm(
      "Are you sure you want to delete this user?"
    );
    if (!confirmed) return;

    try {
      const response = await api.delete(`/users/${id}`);

      if (response.data.status === true) {
        setUsers((prevUsers) => prevUsers.filter((user) => user.id !== id));
      } else {
        console.error(
          "Server error:",
          response.data.message || "Failed to delete."
        );
        alert(response.data.message || "Failed to delete user.");
      }
    } catch (err) {
      console.error("Delete failed:", err);
      alert("Something went wrong while deleting the user.");
    }
  };

  return (
    <div className="dashboard-container">
      <aside className="sidebar">
        <h2>Admin</h2>
        <ul>
          <li>Dashboard</li>
        </ul>
      </aside>
      <main className="main-content">
        <header className="topbar d-flex justify-content-between align-items-center">
          <h4 className="mb-0">Dashboard</h4>
          <div>
            <span className="me-3">{user?.email}</span>
            <button className="btn btn-danger btn-sm" onClick={handleLogout}>
              Logout
            </button>
          </div>
        </header>

        <section className="user-table mt-4">
          <h5>Registered Users</h5>
          <div className="table-responsive">
            <table className="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Email</th>
                  <th>DOB</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                {users.length ? (
                  users.map((u, i) => (
                    <tr key={u.id}>
                      <td>{i + 1}</td>
                      <td>{u.first_name}</td>
                      <td>{u.last_name}</td>
                      <td>{u.email}</td>
                      <td>{u.dob}</td>
                      <td>
                        <button className="btn btn-sm btn-primary me-2">
                          Edit
                        </button>
                        <button
                          className="btn btn-sm btn-danger"
                          onClick={() => handleDelete(u.id)}
                        >
                          Delete
                        </button>
                      </td>
                    </tr>
                  ))
                ) : (
                  <tr>
                    <td colSpan="6" className="text-center">
                      No users found
                    </td>
                  </tr>
                )}
              </tbody>
            </table>
          </div>
        </section>
      </main>
    </div>
  );
};

export default Dashboard;
