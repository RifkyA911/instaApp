<p align="center">
  <img src="https://i.ibb.co/4pwyZ2G/insta-app-copycat.png" width="400" alt="Insta App Copycat Logo">
</p>

<h3 align="center">🚀 Insta App Copycat - Laravel REST API</h3>

<p align="center">
  <img src="https://img.shields.io/badge/Version-1.0-green" alt="Version">
  <img src="https://img.shields.io/badge/License-MIT-blue" alt="License">
  <img src="https://img.shields.io/badge/Laravel-12-red" alt="Laravel Version">
</p>

---

## 📸 About Insta App Copycat

**Insta App Copycat** is a modern RESTful API built with **Laravel 12** designed to mimic Instagram’s core functionalities.  
Easily manage **Users**, **Posts**, **Comments**, **Likes**, and **Followers** — all with **authentication**, **authorization**, and **pagination** baked in.

🎬 **Project demo video:** [Watch on Google Drive](https://drive.google.com/file/d/1Zp0r4YnZ6ocAg4a-LJgmS7iRPu2HAnrZ/view?usp=sharing)

👷 **Frontend repo:** [instaApp-Frontend](https://github.com/RifkyA911/instaApp-Frontend)

---

## ✨ Features

### 👤 User Management

-   User registration & login
-   Secure authentication with **Laravel Sanctum**

### 📝 Post Management

-   Create, read, update, and delete posts
-   Like/Unlike posts
-   Track post edit logs

### 💬 Comment Management

-   Add, edit, delete, and view comments
-   Comment edit logs

---

## 🛠️ Technologies Used

-   **Laravel 12**
-   **Sanctum Authentication**
-   **PostgreSQL**
-   **Bun & Node.js** for frontend integration

---

## 📡 API Routes

⚠️ Import Insomnia workspace from `/import/instaApp.json` for testing.

### User Routes

-   `POST /register` - Register a new user
-   `POST /login` - Login
-   `GET /me` - Retrieve authenticated user
-   `PUT /me` - Update authenticated user
-   `DELETE /me` - Delete authenticated user

### Post Routes

-   `POST /posts` - Create a new post
-   `GET /posts` - Retrieve all posts
-   `GET /posts/{post}` - Retrieve a single post
-   `PUT /posts/{post}` - Update a post
-   `DELETE /posts/{post}` - Delete a post
-   `POST /posts/{post}/likes` - Like a post
-   `DELETE /posts/{post}/likes` - Unlike a post
-   `GET /posts/{post}/edit-log` - Retrieve the edit log of a post

### Comment Routes

-   `POST /comments` - Create a comment
-   `GET /comments` - Retrieve all comments
-   `GET /comments/{comment}` - Retrieve a single comment
-   `PUT /comments/{comment}` - Update a comment
-   `DELETE /comments/{comment}` - Delete a comment
-   `GET /comments/{comment}/edit-log` - Retrieve the edit log of a comment

---

## ⚙️ Installation

```bash
# 1. Clone the repository
git clone https://github.com/yourusername/instaApp-Backend.git
cd instaApp-Backend

# 2. Install dependencies
composer install

# 3. Run migrations
php artisan migrate

# 4. Start the server
php artisan serve
```

---

## 📜 License

Insta App Copycat is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
