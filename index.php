<?php

require 'vendor/autoload.php'; // Include Composer autoload

use Api\Controllers\StudentController;

define('HOST', 1);
define('API', 2);
define('ENDPOINT', 3);
define('ID', 4);

// Get the request path

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

$arrUri = explode('/', $requestUri);





// A kéréshez tartozó útvonal meghatározása
// Egyszerű routing a path alapján
switch ($arrUri[ENDPOINT]) {
    case 'students':
        $studentController = new StudentController();
        if (isset($arrUri[ID]) && is_numeric($arrUri[ID])) {
            $studentController->handleRequest($requestMethod, $arrUri[ID]);
        } else {
            $studentController->handleRequest($requestMethod);
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