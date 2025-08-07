Customer Login System

A full-stack web application that allows customers to register, log in, and manage their accounts. The backend is built with CodeIgniter 4 and MySQL, while the frontend is developed using React.js. This system includes full form validation, secure authentication, and user CRUD operations.

Project Structure

customer-login-system/
├── backend/       # CodeIgniter 4 backend (API)
└── frontend/      # React.js frontend (UI)

Features

User registration (Sign Up)

User login (Sign In)

Form validation

Prevent duplicate registration

Password eye toggle (show/hide password)

Dashboard accessible only after login

User table with Edit and Delete actions

Display logged-in user name

Logout functionality with session destroy

Backend Setup (CodeIgniter 4)

Prerequisites

PHP >= 8.0

Composer

MySQL or MariaDB

Installation

Navigate to the backend directory:

cd backend

Install dependencies:

composer install

Copy .env file and configure your database:

cp env .env

Update the following in .env:

database.default.hostname = localhost
database.default.database = your_database_name
database.default.username = your_username
database.default.password = your_password
database.default.DBDriver = MySQLi

Create a users table in MySQL:

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

The backend will now be running at http://localhost:8080

Frontend Setup (React.js)

Prerequisites

Node.js >= 18.x

npm or yarn

Installation

Navigate to the frontend directory:

cd frontend

Install dependencies:

npm install

Run the development server:

npm start

The frontend will now be running at http://localhost:3000

Tip: Add a proxy in frontend/package.json to avoid CORS issues:

"proxy": "http://localhost:8080"

API Endpoints

Method

Endpoint

Description

POST

/api/signup

Register a new user

POST

/api/login

Authenticate user

GET

/api/users

Fetch all users

PUT

/api/users/:id

Update user by ID

DELETE

/api/users/:id

Delete user by ID

Usage Flow

User lands on Login Page (default route).

Click Sign Up to open the registration form.

Fill in all mandatory fields (DOB is optional).

Upon successful signup, redirected to login.

Login takes user to Dashboard.

Dashboard shows:

User's name on top right

Table of registered users

Edit/Delete buttons per user

Click Logout to destroy session and return to login.

Security

Passwords hashed using PHP's password_hash()

Session-based authentication

CORS enabled on the backend for frontend communication

Protected dashboard route (requires login)

License

This project is for demonstration and testing purposes. Use at your own discretion.

Author

Developed by [Your Name]Date: August 2025

