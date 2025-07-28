SELECT c.title, COUNT(e.student_id) AS total
FROM courses c
LEFT JOIN enrollments e ON c.id = e.course_id
GROUP BY c.id;