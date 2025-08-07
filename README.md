# Customer Login System

A full-stack web application that allows customers to register, log in, and manage their accounts. The backend is built with **CodeIgniter 4** and **MySQL**, while the frontend is developed using **React.js**. This system includes full form validation, secure JWT-based authentication, and user CRUD operations.

---

## 🚀 Features

- Customer **signup** with form validation
- **Duplicate registration** prevention
- **JWT-based login authentication**
- **Dashboard** with:
  - Logged-in user details on top-right
  - Table of all registered users (only visible post-login)
  - **Edit** and **Delete** actions for each user
- Secure JWT session management
- Logout functionality
- Password field with **eye toggle** for visibility

---

## ⚙️ Backend Setup (CodeIgniter 4)

### 🔧 Requirements

- PHP 8.0+
- MySQL/MariaDB
- Composer

### 🛠 Installation

1. Navigate to the `backend/` folder:

   ```bash
   cd backend
   ```

2. Install dependencies:

   ```bash
   composer install
   ```

3. Copy the `.env` file:

   ```bash
   cp env .env
   ```

4. Update `.env` with your DB credentials and JWT secret:

   ```env
   database.default.hostname = localhost
   database.default.database = your_db_name
   database.default.username = your_db_user
   database.default.password = your_db_pass
   database.default.DBDriver = MySQLi

   JWT_SECRET=your_secure_random_key
   ```

5. Run migrations:

   ```bash
   php spark migrate
   ```

6. Start the development server:

   ```bash
   php spark serve
   ```

> Server runs at `http://localhost:8080`

---

## 🌐 Frontend Setup (React)

### ⚙ Requirements

- Node.js (v18+)
- npm or yarn

### 🛠 Installation

1. Navigate to the `frontend/` folder:

   ```bash
   cd frontend
   ```

2. Install dependencies:

   ```bash
   npm install
   ```

3. Start the dev server:

   ```bash
   npm start
   ```

> React app runs at `http://localhost:3000`

### 🔁 CORS Tip

If CORS doesn’t work, try adding this proxy in `package.json`:

```json
"proxy": "http://localhost:8080"
```

---

## 🧩 API Endpoints (Sample)

| Method | Endpoint          | Description              |
| ------ | ----------------- | ------------------------ |
| POST   | `/api/register`   | Register new customer    |
| POST   | `/api/login`      | Login and return JWT     |
| GET    | `/api/users`      | Get all registered users |
| PUT    | `/api/users/{id}` | Update user by ID        |
| DELETE | `/api/users/{id}` | Delete user by ID        |

All secured endpoints require an `Authorization: Bearer <token>` header.

---

## 🛡️ Security Notes

- Passwords are hashed using `password_hash()` (PHP)
- Authentication handled via JWT (no sessions)
- JWT is verified on every protected route via middleware
- CORS enabled for React-to-PHP communication

---

## 🖥️ Screens Overview

### 👤 Login Page

- Default route
- Validates email and password
- Link to Sign Up form

### 📝 Signup Page

- Full form with validation
- Password visibility toggle
- All fields required including DOB

### 📋 Dashboard

- Accessible only after JWT login
- Table view with Edit/Delete
- Logged-in user shown on top-right
- Logout button

---

## 📄 License

MIT — free to use and modify

---

## 👨‍💻 Developed By

Sanjay Kumar
