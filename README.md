# status
✅ Features
One-line HTML form to enter:

Name

Age

Submits data using PHP and stores it in a MySQL database

Displays all submitted records in an HTML table

Each record has a "Toggle" button to switch status between 0 and 1

Toggle uses AJAX (JavaScript) for instant update without refreshing the page

Everything is handled in one single index.php file

📦 Requirements
PHP 7.0+

MySQL or MariaDB

Apache or compatible web server (e.g. XAMPP, WAMP, LAMP stack)

🛠️ Setup Instructions
1. Create the Database Table
Run the following SQL in your MySQL database:

sql
نسخ
تحرير
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    status TINYINT(1) DEFAULT 0
);
2. Edit Database Credentials
In the index.php file, update these lines with your database credentials:

php
نسخ
تحرير
$host = 'localhost';
$db   = 'your_database_name';
$user = 'your_username';
$pass = 'your_password';
3. Deploy the File
Place index.php in your server’s public folder (e.g., htdocs in XAMPP)

Open it in your browser: http://localhost/index.php

🧪 Usage
Fill in the Name and Age fields

Click Submit to add a new record

Below the form, view the full table of users

Click the "Toggle" button to switch the status between 0 and 1

The change is immediate and doesn’t reload the page

📁 File Structure
bash
نسخ
تحرير
project-folder/
└── index.php
All HTML, CSS, JavaScript, and PHP logic are inside index.php
