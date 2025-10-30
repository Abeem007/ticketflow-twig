<?php
require_once 'config.php';
require_once 'includes/auth.php';

// Check auth (simple session check)
if (!isset($_SESSION['user'])) {
    header('Location: /ticketflow-twig/auth/login');
    exit;
}

echo $twig->render('dashboard.twig', [
    'page_title' => 'Dashboard | TicketFlow',
    'user' => $_SESSION['user'] ?? []
]);
?>