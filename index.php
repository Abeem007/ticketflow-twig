<?php
require_once __DIR__ . '/config.php';

// Get the requested page
$page = $_GET['page'] ?? 'landing';

// Route mapping
$routes = [
    'landing' => 'landing.twig',
    '' => 'landing.twig',
    'login' => 'login.twig',
    'signup' => 'signup.twig',
    'dashboard' => 'dashboard.twig',
    'tickets' => 'tickets.twig',
];

// Get template
$template = $routes[$page] ?? 'landing.twig';

// Render
try {
    echo $twig->render($template, [
        'page' => $page,
        'base_url' => $baseUrl
    ]);
} catch (Exception $e) {
    http_response_code(404);
    echo '<h1>404 - Page Not Found</h1>';
    echo '<p>' . htmlspecialchars($e->getMessage()) . '</p>';
}
?>