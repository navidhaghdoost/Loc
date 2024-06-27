<?php


require '../app/Controllers/LocationController.php';

$locationController = new LocationController($pdo, $jwt_key);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $locationController->updateLocation($token, $lat, $lng);
}

