<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config/config.php';
require __DIR__ . '/../Models/Trip.php';

use \Firebase\JWT\JWT;

class TripController {
    private $tripModel;
    private $jwt_key;

    public function __construct($pdo, $jwt_key) {
        $this->tripModel = new Trip($pdo);
        $this->jwt_key = $jwt_key;
    }

    public function startTrip($token) {
        try {
            $decoded = JWT::decode($token, $this->jwt_key, array('HS256'));
            $user_id = $decoded->data->user_id;
            $this->tripModel->startTrip($user_id);
            echo json_encode(['message' => 'Trip started']);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid token']);
        }
    }

    public function endTrip($token) {
        try {
            $decoded = JWT::decode($token, $this->jwt_key, array('HS256'));
            $user_id = $decoded->data->user_id;
            $this->tripModel->endTrip($user_id);
            echo json_encode(['message' => 'Trip ended']);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid token']);
        }
    }
}
?>
