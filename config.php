<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader([
    __DIR__ . '/templates',
    __DIR__ . '/templates/partials'
]);

$twig = new \Twig\Environment($loader, [
    'cache' => false,
    'debug' => true
]);

// Base URL - empty for production
$baseUrl = '';

function isLoggedIn() {
    return isset($_SESSION['user_id']) || isset($_SESSION['user']);
}
?>