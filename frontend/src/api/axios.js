import axios from "axios";

const instance = axios.create({
  baseURL: "http://localhost:9000/api", // ✅ Global API prefix
  headers: {
    "Content-Type": "multipart/form-data",
  },
});

// Add JWT token automatically from localStorage (optional)
instance.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem("token");
    if (token) {
      config.headers["Authorization"] = `Bearer ${token}`;
    }
    return config;
  },
  (error) => Promise.reject(error)
);

export default instance;
