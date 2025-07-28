-- Table for ENUM version
CREATE TABLE users_enum (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender ENUM('male', 'female', 'other') DEFAULT 'other'
);

-- Table for TINYINT version
CREATE TABLE users_int (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    gender TINYINT DEFAULT 2
);
