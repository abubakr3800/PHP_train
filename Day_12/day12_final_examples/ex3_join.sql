SELECT name FROM students
WHERE id IN (
  SELECT student_id FROM enrollments
  GROUP BY student_id
  HAVING COUNT(*) > 1
);