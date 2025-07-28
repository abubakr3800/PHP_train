CREATE VIEW student_courses AS
SELECT s.name AS student_name, c.title AS course_title
FROM students s
JOIN enrollments e ON s.id = e.student_id
JOIN courses c ON c.id = e.course_id;

SELECT * FROM student_courses WHERE course_title = 'Web Development';
