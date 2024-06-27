<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config/config.php';
require __DIR__ . '/../Models/Location.php';

use \Firebase\JWT\JWT;

class LocationController {
    private $locationModel;
    private $jwt_key;

    public function __construct($pdo, $jwt_key) {
        $this->locationModel = new Location($pdo);
        $this->jwt_key = $jwt_key;
    }

    public function updateLocation($token, $lat, $lng) {
        try {
            $decoded = JWT::decode($token, $this->jwt_key, array('HS256'));
            $user_id = $decoded->data->user_id;
            $this->locationModel->saveLocation($user_id, $lat, $lng);
            echo json_encode(['message' => 'Location updated']);
        } catch (Exception $e) {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid token']);
        }
    }
}
?>
