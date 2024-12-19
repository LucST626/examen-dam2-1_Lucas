CREATE DATABASE IF NOT EXISTS testdb;
USE testdb;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    password VARCHAR(100)
);

INSERT INTO users (name, password) VALUES
('Alice', 'password123'),
('Bob', 'securepassword'),
('Charlie', 'anotherpassword');
