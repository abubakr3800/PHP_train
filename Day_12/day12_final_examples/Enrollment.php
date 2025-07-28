
<?php
class Enrollment {
  private $conn;
  private $table = "enrollments";

  public function __construct($db) {
    $this->conn = $db;
  }

  public function getStudentCourseCount() {
    $sql = "SELECT s.name, COUNT(e.course_id) AS total
            FROM students s
            JOIN enrollments e ON s.id = e.student_id
            GROUP BY s.id";
    return $this->conn->query($sql)->fetch_all(MYSQLI_ASSOC);
  }
}
?>
