<?php

require '../config/config.php';
require '../app/Controllers/AuthController.php';
require '../app/Controllers/LocationController.php';
require '../app/Controllers/TripController.php';

// Parse the URL path to determine the requested route
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

// Initialize controllers
$authController = new AuthController($pdo, $jwt_key);
$locationController = new LocationController($pdo, $jwt_key);
$tripController = new TripController($pdo, $jwt_key);

// Route the request to the appropriate controller and method
switch ($path) {
    case '/loc/public/login':
        if ($method === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $authController->login($username, $password);
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
        break;

    case '/loc/public/update_location':
        if ($method === 'POST') {
            $token = $_POST['token'];
            $lat = $_POST['lat'];
            $lng = $_POST['lng'];
            $locationController->updateLocation($token, $lat, $lng);
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
        break;

    case '/loc/public/start_trip':
        if ($method === 'POST') {
            $token = $_POST['token'];
            $tripController->startTrip($token);
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
        break;

    case '/loc/public/end_trip':
        if ($method === 'POST') {
            $token = $_POST['token'];
            $tripController->endTrip($token);
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
        }
        break;

    default:
        http_response_code(404);
        echo json_encode(['message' => 'Not Found']);
        break;
}
?>
