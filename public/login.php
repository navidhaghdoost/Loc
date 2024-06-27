<?php

require '../app/Controllers/AuthController.php';

$authController = new AuthController($pdo, $jwt_key);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // دریافت داده‌های POST به صورت JSON
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['username']) && isset($input['password'])) {
        $username = $input['username'];
        $password = $input['password'];
        $authController->login($username, $password);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request: Missing username or password']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
}
?>

