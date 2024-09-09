<?php

use Api\Controllers\StudentController;

// require_once 'StudentController.php';
// require_once 'TeacherController.php';

// URL és HTTP metódus kiolvasása
$requestUri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// A kéréshez tartozó útvonal meghatározása
$path = parse_url($requestUri, PHP_URL_PATH);

// Egyszerű routing a path alapján
switch ($path) {
    case '/students':
        $studentController = new StudentController();
        if (isset($_GET['id'])) {
            $studentController->handleRequest($method, $_GET['id']);
        } else {
            $studentController->handleRequest($method);
        }
        break;
/*

    case '/teachers':
        $teacherController = new TeacherController();
        if (isset($_GET['id'])) {
            $teacherController->handleRequest($method, $_GET['id']);
        } else {
            $teacherController->handleRequest($method);
        }
        break;
*/

    default:
        // Hibakezelés, ha nem létezik az útvonal
        http_response_code(404);
        echo json_encode(["message" => "Resource not found"]);
        break;
}
