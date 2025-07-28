SELECT student_id, COUNT(*) as total
FROM enrollments
GROUP BY student_id;