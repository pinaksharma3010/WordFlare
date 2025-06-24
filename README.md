# WordFlare 📝  
A Full-Featured PHP + MySQL Blog Application with User Authentication, Role Management, and Advanced Features

## 📌 Overview
**WordFlare** is a dynamic web application built with **PHP** and **MySQL**, enabling users to perform CRUD operations on blog posts. It features a login system with hashed passwords, user roles (admin/editor), advanced search, pagination, and secure coding practices.

---

## ⚙️ Features

### ✅ Core Functionality 
- **User Registration & Login** with password hashing
- **Session-based Authentication**
- **CRUD Operations** on blog posts:
  - Create new posts
  - View all posts
  - Edit posts
  - Delete posts

### 🔍 Advanced Features 
- **Search Posts** by title or content
- **Pagination** on the post listing page
- **Responsive UI** using Bootstrap

### 🔐 Security Enhancements 
- **Prepared Statements** with PDO (SQL injection protection)
- **Client-side + Server-side Form Validation**
- **Role-based Access Control** (Admin can edit/delete all posts, editors have limited access)

---

🛠️ Tech Stack
- **Backend:** PHP (with PDO)
- **Frontend:** HTML, CSS, Bootstrap
- **Database:** MySQL
- **Tools:** XAMPP / phpMyAdmin (Local Dev), Git, GitHub

---

## 🚀 Setup Instructions

### 🔧 Local Installation (Using XAMPP)
1. Clone or download the repository:
   ```bash
   git clone https://github.com/yourusername/wordflare.git
````

2. Move the folder to:

   ```
   C:\xampp\htdocs\wordflare
   ```

3. Start **XAMPP**:

   * Start `Apache` and `MySQL`

4. Open phpMyAdmin and import the database:

   * Create a new database named `blog`
   * Import `blog.sql` from the project root

5. Update `config.php` if needed:

   ```php
   $host = 'localhost';
   $db   = 'blog';
   $user = 'root';
   $pass = '';
   ```

6. Open in browser:

   ```
   http://localhost/php-project/

   ```

---

 🔐 Default User Roles

You can manually assign roles from phpMyAdmin or extend the registration form to choose roles.

Example:

| Username | Password  | Role   |
| -------- | --------- | ------ |
| admin    | admin123  | admin  |
| editor1  | editor123 | editor |

---



 📂 Project Structure

```
/PHP-Project
│
├── add_post.php
├── config.php
├── dashboard.php
├── delete_post.php
├── edit_post.php
├── header.php
├── index.php
├── login.php
├── logout.php
├── register.php
├── search.php
├── style.css
├── blog.sql
└── README.md
```

---

 ✅ Security Measures

* Passwords hashed with `password_hash()`
* Database interactions secured using **PDO prepared statements**
* Session-based access control
* Role-based permissions to restrict access
* Form validation (client + server side)

---

 🙌 Credits

Developed by **Pinak Sharma**
