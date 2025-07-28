
USE training_system;

INSERT INTO students (name, email, phone, date_of_birth)
VALUES
  ('Ahmed Ali', 'ahmed@example.com', '01111111111', '2000-05-10'),
  ('Sara Youssef', 'sara@example.com', '01222222222', '2001-01-20');

INSERT INTO courses (title, description, hours, price)
VALUES
  ('Web Development', 'Intro to HTML, CSS, PHP', 40.00, 1500.00),
  ('MySQL Basics', 'Database fundamentals', 20.00, 1000.00);

INSERT INTO enrollments (student_id, course_id, grade)
VALUES
  (1, 1, 85.5),
  (2, 2, 90.0);
