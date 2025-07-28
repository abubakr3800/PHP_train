SELECT name, COUNT(*) as total
FROM students JOIN enrollments ON enrollments.student_id = students.id
GROUP BY student_id
HAVING COUNT(*) > 2;