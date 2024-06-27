<?php

require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config/config.php';
require __DIR__ . '/../Models/User.php';

use \Firebase\JWT\JWT;

class AuthController {
    private $userModel;
    private $jwt_key;

    public function __construct($pdo, $jwt_key) {
        $this->userModel = new User($pdo);
        $this->jwt_key = $jwt_key;
    }

    public function login($username, $password) {
        $user_id = $this->userModel->authenticate($username, $password);

        if ($user_id) {
            $payload = [
                'iss' => "https://087e-91-243-167-241.ngrok-free.app", // دامنه شما
                'aud' => "https://087e-91-243-167-241.ngrok-free.app", // دامنه شما
                'iat' => time(),
                'nbf' => time(),
                'exp' => time() + (60*60), // 1 hour expiration
                'data' => [
                    'user_id' => $user_id
                ]
            ];

            $jwt = JWT::encode($payload, $this->jwt_key, 'HS256'); // اضافه کردن الگوریتم
            echo json_encode(['token' => $jwt]);
        } else {
            http_response_code(401);
            echo json_encode(['message' => 'Invalid credentials']);
        }
    }
}
?>
