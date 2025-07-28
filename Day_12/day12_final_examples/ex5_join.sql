SELECT name FROM students
WHERE id NOT IN (SELECT student_id FROM enrollments);
