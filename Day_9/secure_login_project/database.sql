CREATE DATABASE IF NOT EXISTS secure_login CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE secure_login;

CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Example hashed password: 1234 => use PHP password_hash() to insert
-- INSERT INTO admin (username, email, password) VALUES ('admin', 'admin@example.com', '$2y$10$EXAMPLE_HASHED_PASS');
