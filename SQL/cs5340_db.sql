-- Create a new database if it doesn't exist (optional)
CREATE DATABASE IF NOT EXISTS CS5340_db;

-- Use the CS5340_db database
USE CS5340_db;

-- Create a table to store user login details
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    UNIQUE KEY unique_username (username)
);
