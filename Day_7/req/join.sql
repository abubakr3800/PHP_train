
-- استخرج اسم الطالب وكورس مسجل فيه:
SELECT students.name, courses.title
FROM students
JOIN enrollments ON students.id = enrollments.student_id
JOIN courses ON courses.id = enrollments.course_id;
