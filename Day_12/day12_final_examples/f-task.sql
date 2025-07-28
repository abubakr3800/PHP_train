SELECT s.name, COUNT(e.course_id) AS total
FROM students s
JOIN enrollments e ON s.id = e.student_id
GROUP BY s.id;