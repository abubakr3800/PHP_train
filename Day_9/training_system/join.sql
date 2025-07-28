SELECT e.id, s.name AS student, c.title AS course, e.grade, e.enrollment_date
              FROM enrollments e
              JOIN students s ON e.student_id = s.id
              JOIN courses c ON e.course_id = c.id



              SELECT students.name , students.date_of_birth , students.date_of_birth , enrollments.enrollment_date , enrollments.grade  FROM `enrollments` JOIN students ON students.id= enrollments.student_id


              SELECT * FROM `enrollments` JOIN students ON students.id= enrollments.student_id