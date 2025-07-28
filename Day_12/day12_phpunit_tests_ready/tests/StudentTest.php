<?php
require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../Student.php';
require_once __DIR__ . '/../Database.php';

use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase {
    public function testGetAllStudents() {
        $db = new Database();
        $conn = $db->connect();
        $student = new Student($conn);

        $result = $student->getAll();
        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
    }
}


