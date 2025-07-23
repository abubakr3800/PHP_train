
CREATE DATABASE IF NOT EXISTS file_manager CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE file_manager;

-- جدول المستخدمين
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) UNIQUE NOT NULL,
  password VARCHAR(255) NOT NULL,
  email VARCHAR(150),
  job VARCHAR(100),
  avatar VARCHAR(255),
  is_admin BOOLEAN DEFAULT 0,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- جدول السجلات (login, upload)
CREATE TABLE logs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  action VARCHAR(50), -- login, upload
  file_type VARCHAR(50), -- avatar, product
  full_path TEXT,
  mime_type VARCHAR(100),
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- جدول الملفات المرفوعة
CREATE TABLE uploads (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  file_name VARCHAR(255),
  file_type VARCHAR(50),
  mime_type VARCHAR(100),
  upload_path TEXT,
  uploaded_at DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
