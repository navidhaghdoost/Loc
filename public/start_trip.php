<?php


require '../app/Controllers/TripController.php';

$tripController = new TripController($pdo, $jwt_key);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $token = $_POST['token'];
    $tripController->startTrip($token);
}

