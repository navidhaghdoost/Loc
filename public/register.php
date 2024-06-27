<?php

require '../app/Controllers/RegisterController.php';

$registerController = new RegisterController($pdo);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['username']) && isset($input['password'])) {
        $username = $input['username'];
        $password = $input['password'];
        $registerController->register($username, $password);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request: Missing username or password']);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Method Not Allowed']);
}
?>
