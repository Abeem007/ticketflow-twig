<?php

require_once 'vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => false, 
    'debug' => true,
]);

$basePath = '';

$twig->addGlobal('site_name', 'TicketFlow');
$twig->addGlobal('base_path',$basePath ); // Adjust if not in subdir


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>