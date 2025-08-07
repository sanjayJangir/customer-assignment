<img src="https://r2cdn.perplexity.ai/pplx-full-logo-primary-dark%402x.png" style="height:64px;margin-right:32px"/>

# Customer Login System

A full-stack web application that allows customers to register, log in, and manage their accounts. The backend is built with CodeIgniter 4 and MySQL, while the frontend is developed using React.js. This system includes full form validation, secure authentication, and user CRUD operations.
🚀 Features
Customer signup with form validation
Duplicate registration prevention
Login authentication
Dashboard with:
Logged-in user details on top-right
Table of all registered users (only visible post-login)
Edit and Delete actions for each user
Secure session management
Logout functionality
Password field with eye toggle for visibility
⚙️ Backend Setup (CodeIgniter 4)
🔧 Requirements
PHP 8.0+
MySQL/MariaDB
Composer
🛠 Installation
Navigate to the backend/ folder:
cd backend
Install dependencies:
composer install
Copy the .env file:
cp env .env
Update .env with your DB credentials:
database.default.hostname = localhost
database.default.database = your_db_name
database.default.username = your_db_user
database.default.password = your_db_pass
database.default.DBDriver = MySQLi
Run migrations or manually create users table:
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY,
first_name VARCHAR(100) NOT NULL,
last_name VARCHAR(100) NOT NULL,
email VARCHAR(255) UNIQUE NOT NULL,
password VARCHAR(255) NOT NULL,
dob DATE NULL,
created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
Start the development server:
php spark serve
Server runs at http://localhost:8080
🌐 Frontend Setup (React)
⚙ Requirements
Node.js (v18+)
npm or yarn
🛠 Installation
Navigate to the frontend/ folder:
cd frontend
Install dependencies:
npm install
Start the dev server:
npm start
React app runs at http://localhost:3000
🔁 CORS Tip
If CORS doesn’t work, try adding this proxy in package.json:
"proxy": "http://localhost:8080"
🧩 API Endpoints (Sample)
MethodEndpointDescription
POST
/api/signup
Register new customer
POST
/api/login
Login and start session
GET
/api/users
Get all registered users
PUT
/api/users/{id}
Update user by ID
DELETE
/api/users/{id}
Delete user by ID
🛡️ Security Notes
Passwords are hashed using password_hash() (PHP)
Authenticated routes protected via session or token (recommended: JWT)
CORS enabled to allow React to communicate with backend
🖥️ Screens Overview
👤 Login Page
Default route
Validates email and password
Link to Sign Up form
📝 Signup Page
Full form with validation
Password visibility toggle
All fields required except DOB
📋 Dashboard
Accessible only after login
Table view with Edit/Delete
Logout button (top-right)
📄 License
MIT — free to use and modify
👨‍💻 Developed By
[Your Name or Team]
For test/demo purposes only.
Date: August 2025
need readme file proper code

Certainly! Here is a **professional and complete README.md** for your Customer Login System. This includes clear sections, code blocks, setup instructions for both backend (CodeIgniter 4) and frontend (React.js), database schema, API endpoints, and key features—ready for any GitHub or project documentation.

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

[Your Name or Team]

> For test/demo purposes only.
> Date: August 2025

### (Optional)

**Feel free to improve or extend this starter project!**

**Happy coding!** 🚀

> _You can copy-paste this as your `README.md`. For source code examples (controller, routes, React pages, etc.) just ask for specific files or components!_
