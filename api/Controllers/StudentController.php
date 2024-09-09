<?php
namespace Api\Controllers;

use Api\Repositories\StudentRepository;

class StudentController {
    private $studentRepository;

    public function __construct() {
        $this->studentRepository = new StudentRepository();
    }

    public function handleRequest($method, $id = null) {
        switch ($method) {
            case 'GET':
                if ($id) {
                    $this->getStudentById($id);
                } else {
                    $this->getAllStudents();
                }
                break;
            case 'POST':
                $this->addStudent();
                break;
            case 'PUT':
                $this->updateStudent($id);
                break;
            case 'DELETE':
                $this->deleteStudent($id);
                break;
            default:
                http_response_code(405); // Method Not Allowed
                echo json_encode(["message" => "Method not allowed"]);
        }
    }

    public function getAllStudents() {
        $students = $this->studentRepository->getAllStudents();
        echo json_encode($students, JSON_THROW_ON_ERROR);
    }

    public function getStudentById($id) {
        $student = $this->studentRepository->getStudentById($id);
        if ($student) {
            echo json_encode($student, JSON_THROW_ON_ERROR);
        } else {
            http_response_code(404);
            echo json_encode(["message" => "Student not found"]);
        }
    }

    public function addStudent() {
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'] ?? '';
        $classCode = $data['class_id'] ?? '';
        if ($this->studentRepository->addStudent($name, $classCode)) {
            echo json_encode(["message" => "Student added successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Failed to add student"]);
        }
    }

    public function updateStudent($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        $name = $data['name'] ?? '';
        $classCode = $data['class_id'] ?? '';
        if ($this->studentRepository->updateStudent($id, $name, $classCode)) {
            echo json_encode(["message" => "Student updated successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Failed to update student"]);
        }
    }

    public function deleteStudent($id) {
        if ($this->studentRepository->deleteStudent($id)) {
            echo json_encode(["message" => "Student deleted successfully"]);
        } else {
            http_response_code(500);
            echo json_encode(["message" => "Failed to delete student"]);
        }
    }
}
