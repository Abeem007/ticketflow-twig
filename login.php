<?php
session_start();
header('Content-Type: application/json');

// Read JSON input from fetch()
$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

// Validate fields
if (empty($data['email']) || empty($data['password'])) {
    echo json_encode([
        "success" => false,
        "message" => "Email and password are required."
    ]);
    exit;
}

$email = trim($data['email']);
$password = trim($data['password']);

// 🔹 For now, we’ll use a mock user (like your JS example)
$mock_user = [
    "email" => "admin@test.com",
    "password" => "password"
];

// Check credentials
if ($email === $mock_user['email'] && $password === $mock_user['password']) {
    // Store session user info
    $_SESSION['user'] = [
        "email" => $mock_user['email']
    ];

    echo json_encode([
        "success" => true,
        "message" => "Login successful."
    ]);
    exit;
} else {
    echo json_encode([
        "success" => false,
        "message" => "Invalid email or password."
    ]);
    exit;
}
