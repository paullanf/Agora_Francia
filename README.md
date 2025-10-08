# Agora Francia

Collaborative web project developed as part of the ECE Paris engineering program.  
This project was created in a team with [@Quentinthpt](https://github.com/Quentinthpt) and other collaborators.  
The goal was to design a **dynamic web platform**, inspired by an online “agora,” allowing users to share posts, comment, and engage in discussions on various topics.

---

## Project Objectives

- Develop a **dynamic web application** using PHP and a relational database.  
- Implement a clear **front-end / back-end structure** (HTML/CSS/JS for the client side, PHP/MySQL for the server side).  
- Integrate **user authentication** and **session management**.  
- Design a **clean and responsive interface**.  
- Collaborate effectively using Git and GitHub.

---

## Main Features

- User registration, login, and logout (with session management)  
- Post and comment creation  
- Content moderation (delete / edit posts)  
- User role management (user, moderator, admin)  
- Dynamic content loading from the database  
- Responsive web design for desktop and mobile

---

## Tech Stack

| Component | Technology |
|------------|-------------|
| **Backend** | PHP 8 |
| **Database** | MySQL |
| **Frontend** | HTML, CSS, JavaScript |
| **Local server** | XAMPP / WAMP / MAMP |
| **Version control** | Git & GitHub |

---

## Project Structure

Agora_Francia/
│
├── assets/ # CSS, JS, images
├── includes/ # Shared PHP files (headers, footers, database config)
├── pages/ # Main pages (home, profile, forum, admin, etc.)
├── database.sql # SQL script to create the database
├── index.php # Main entry point
├── login.php / register.php
└── README.md

---

## Installation and Usage

### 1. Clone the project
'''bash
git clone https://github.com/paullanf/Agora_Francia.git
cd Agora_Francia'''

### 2. Configure your environment

Install XAMPP, WAMP, or MAMP

Place the project folder inside your htdocs/ directory

Start Apache and MySQL

### 3. Import the database

Open phpMyAdmin at http://localhost/phpmyadmin

Create a database named agora_francia

Import the database.sql file

### 4. Update database connection settings

In includes/config.php (or equivalent file):

$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'agora_francia';

### 5. Launch the application

Go to:
http://localhost/Agora_Francia
