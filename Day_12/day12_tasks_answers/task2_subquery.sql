-- Task 2: الطالب المسجل في أكبر عدد من الكورسات
SELECT name FROM students
WHERE id = (
  SELECT student_id FROM enrollments
  GROUP BY student_id
  ORDER BY COUNT(*) DESC
  LIMIT 1
);
