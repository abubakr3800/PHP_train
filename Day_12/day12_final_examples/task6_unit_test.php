<?php
use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase {
  public function testGetById() {
    $student = new Student($conn);
    $this->assertEquals("Ahmed", $student->getById(1)['name']);
  }
}
?>