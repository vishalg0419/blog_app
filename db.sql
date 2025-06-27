CREATE DATABASE blog_app;
USE blog_app;

-- Minimal table structure
CREATE TABLE blogs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255),
  author_name VARCHAR(100),
  category VARCHAR(50),
  image_name VARCHAR(255),
  blog_content TEXT,
  publish_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status ENUM('draft','published') DEFAULT 'draft'
);

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE,
  password VARCHAR(255)
);
