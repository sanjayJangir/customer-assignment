# Customer Login System

A **full-stack web application** for customer registration, login, and account management.
**Backend:** CodeIgniter 4 \& MySQL
**Frontend:** React.js

## 🚀 Features

- **Customer signup** with full form validation
- **Duplicate registration** prevention
- **Login authentication**
- **Dashboard:**
  - Shows current user (top-right)
  - Lists all registered users (only visible after login)
  - Edit/Delete for each user
- **Secure session management**
- **Logout** function
- **Password show/hide** on forms
- **All API secured** (sessions or JWT recommended)

## ⚙️ Backend Setup (CodeIgniter 4 / PHP)

### Requirements

- PHP 8.0+
- MySQL/MariaDB
- Composer

### Installation

1. **Clone or navigate to your project:**

```bash
cd backend
```

2. **Install dependencies:**

```bash
composer install
```

3. **Copy example environment file and configure:**

```bash
cp env .env
```

    - Edit `.env` and set your database credentials:

```env
database.default.hostname = localhost
database.default.database = your_db_name
database.default.username = your_db_user
database.default.password = your_db_pass
database.default.DBDriver = MySQLi
```

4. **Create the `users` table:**

Either run the migration (if provided), or run this SQL manually:

```sql
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  first_name VARCHAR(100) NOT NULL,
  last_name VARCHAR(100) NOT NULL,
  email VARCHAR(255) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  dob DATE NULL,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```

5. **Start the development server:**

```bash
php spark serve
```

> Server runs at http://localhost:8080

## 🌐 Frontend Setup (React.js)

### Requirements

- Node.js v18+
- npm or yarn

### Installation

1. **Navigate to frontend directory:**

```bash
cd frontend
```

2. **Install dependencies:**

```bash
npm install
```

<sub>or use `yarn`</sub> 3. **Start the React development server:**

```bash
npm start
```

> React runs at http://localhost:3000

### 🔁 CORS Tip

If you get CORS errors in development, add a `"proxy"` entry inside your `frontend/package.json`:

```json
"proxy": "http://localhost:8080"
```

## 🧩 API Endpoints

| Method | Endpoint          | Description             |
| :----- | :---------------- | :---------------------- |
| POST   | `/api/signup`     | Register new customer   |
| POST   | `/api/login`      | Login and start session |
| GET    | `/api/users`      | Get all users           |
| PUT    | `/api/users/{id}` | Update user by ID       |
| DELETE | `/api/users/{id}` | Delete user by ID       |

## 🛡️ Security Notes

- **Passwords are securely hashed** (PHP `password_hash()` / `password_verify()`)
- **Authenticated API routes**: protected with session-based authentication (can be extended to JWT)
- **CORS enabled** in the backend for local development

## 🖥️ Screens Overview

- **Login Page:**
  - Validates email/password
  - Link to Sign Up
- **Registration Page:**
  - All fields validated
  - Password visibility toggle
- **Dashboard:**
  - Accessible only after login
  - Table of users (edit/delete for each)
  - Current user shown top-right
  - Logout button

## 📄 License

MIT — Free to use, modify, and share.

## 👨💻 Developed By

Sanjay Kumar
sk857065@gmail.com

**Feel free to improve or extend this starter project!**

**Happy coding!** 🚀
