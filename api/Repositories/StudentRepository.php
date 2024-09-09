<?php
namespace Api\Repositories;

use Api\Database\DatabaseConnection;
use PDO;

class StudentRepository {
    private $db;

    public function __construct() {
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    public function getAllStudents() {
        $query = $this->db->prepare("SELECT * FROM students");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStudentById($id) {
        $query = $this->db->prepare("SELECT * FROM students WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function addStudent($name, $classCode) {
        $query = $this->db->prepare("INSERT INTO students (name, class_id) VALUES (?, ?)");
        return $query->execute([$name, $classCode]);
    }

    public function updateStudent($id, $name, $classCode) {
        $query = $this->db->prepare("UPDATE students SET name = ?, class_id = ? WHERE id = ?");
        return $query->execute([$name, $classCode, $id]);
    }

    public function deleteStudent($id) {
        $query = $this->db->prepare("DELETE FROM students WHERE id = ?");
        return $query->execute([$id]);
    }
}
