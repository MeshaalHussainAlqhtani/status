# status
What it does
This project is a simple web page that:

Lets users enter their name and age

Saves the data into a MySQL database

Shows all saved users in a table

Allows toggling a status (0 or 1) for each user using a button

Updates the status instantly using JavaScript (AJAX)

Everything is inside one file: index.php

Requirements
You need:

A web server with PHP support (XAMPP, WAMP, or LAMP)

PHP version 7.0 or higher

MySQL or MariaDB

Setup Instructions
Create the database table

Open your MySQL and run this:

sql

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT NOT NULL,
    status TINYINT(1) DEFAULT 0
);
Edit database settings

In the index.php file, update this section with your database info:

php

$host = 'localhost';
$db   = 'your_database_name';
$user = 'your_username';
$pass = 'your_password';
Place the file on your server

Copy index.php to your server's root folder:

For XAMPP: htdocs/

For WAMP: www/

For LAMP: /var/www/html/

Open in browser

Go to:

arduino


http://localhost/index.php
How to use
Enter name and age in the form

Click Submit to save the user

The user will appear in the table below

Click the "Toggle" button to change the status between 0 and 1

The status will update instantly without reloading the page

Notes
Uses PDO for database connection

Basic input checks only (you can add validation and security later)

For practice and small demo use onl
