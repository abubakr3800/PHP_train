<?php
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase {
  public function testGetById() {
    $db = new Database();
    $conn = $db->connect();
    $student = new Student($conn);
    $result = $student->getById(1);
    $this->assertEquals("Ahmed", $result['name']);
  }
}
?>