-- Task 1: عدد الطلاب المسجلين في كل كورس
SELECT c.title, COUNT(e.student_id) AS total_students
FROM courses c
LEFT JOIN enrollments e ON c.id = e.course_id
GROUP BY c.id;
