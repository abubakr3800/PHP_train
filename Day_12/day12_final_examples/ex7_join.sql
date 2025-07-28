SELECT course_id, COUNT(*) as total
FROM enrollments
GROUP BY course_id;