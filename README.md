# 🛠️ Task Management API (Laravel + Sanctum)

This is a RESTful API built with **Laravel** and **Laravel Sanctum** for authentication.  
It provides a complete **Task Management System** with secure user authentication and full CRUD operations.

---

## 🚀 Features

- ✅ User Registration & Login (Token-based authentication using Sanctum)
- ✅ Secure API routes with `auth:sanctum` middleware
- ✅ Task Management (Create, Read, Update, Delete)
- ✅ User-wise task access (Each user sees only their own tasks)
- ✅ Clean architecture with Controllers, Models & Validation
- ✅ Proper API error handling and validation

---

## ⚙️ Tech Stack

- **Laravel** (Backend Framework)
- **Laravel Sanctum** (Authentication)
- **MySQL** (Database)
- **REST API**

---

## 📁 Project Setup

### 1️⃣ Clone the repository
```bash
git clone https://github.com/your-username/task-api-laravel.git
cd task-api-laravel


## Install dependencies

composer install or update

## Configure environment

cp .env.example .env

## Generate app key

php artisan key:generate

## Run MIgration 

php artisan migrate

## install Sanctum

php artisan install:api

## Run The server

php artisan serve