<?php
// config.php
if (session_status() === PHP_SESSION_NONE) {
    session_start(); // optional, not used for auth
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

$baseUrl = '/ticketflow-twig';

// Helper: only for Twig context
function isLoggedIn() {
    return false; // We don't trust PHP session
}