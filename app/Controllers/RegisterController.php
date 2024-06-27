<?php


require __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../config/config.php';
require __DIR__ . '/../Models/User.php';

class RegisterController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function register($username, $password)
    {
        $this->userModel->create($username, $password);
        echo json_encode(['message' => 'User registered successfully']);
    }
}

