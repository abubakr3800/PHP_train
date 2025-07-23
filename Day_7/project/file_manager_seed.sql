
USE file_manager;

INSERT INTO users (username, password, email, job, avatar, is_admin)
VALUES 
('admin', 'admin123', 'admin@mail.com', 'Developer', 'uploads/profiles/default.png', 1),
('user1', '123456', 'user1@mail.com', 'Designer', 'uploads/profiles/user1.png', 0);

INSERT INTO logs (user_id, action, file_type, full_path, mime_type)
VALUES
(1, 'login', NULL, NULL, NULL),
(1, 'upload', 'avatar', 'uploads/profiles/default.png', 'image/png');

INSERT INTO uploads (user_id, file_name, file_type, mime_type, upload_path)
VALUES
(1, 'default.png', 'avatar', 'image/png', 'uploads/profiles/default.png');
