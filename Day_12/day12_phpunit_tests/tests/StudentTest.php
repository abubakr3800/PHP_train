<?php
use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../Student.php';
require_once __DIR__ . '/../Database.php';

class StudentTest extends TestCase {
  private $conn;
  private $student;

  protected function setUp(): void {
    $db = new Database();
    $this->conn = $db->connect();
    $this->student = new Student($this->conn);
  }

  public function testCreateStudent() {
    $result = $this->student->create("Unit Test", "unit@test.com");
    $this->assertTrue($result);
  }

  public function testGetById() {
    $this->student->create("Test User", "test@php.com");
    $id = $this->conn->insert_id;
    $result = $this->student->getById($id);
    $this->assertEquals("Test User", $result['name']);
  }

  public function testDeleteStudent() {
    $this->student->create("Delete Me", "delete@test.com");
    $id = $this->conn->insert_id;
    $this->assertTrue($this->student->delete($id));
  }
}
?>
