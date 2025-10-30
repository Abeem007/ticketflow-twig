<?php
require_once 'config.php';
require_once 'includes/auth.php'; // For any server-side helpers

// Handle POST login (client-side in auth.js, but add server echo for demo)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TODO: Real auth here (e.g., check DB/session)
    $_SESSION['user'] = ['email' => $_POST['email'] ?? ''];
    header('Location: /ticketflow-twig/dashboard');
    exit;
}

// Render login template
echo $twig->render('login.twig', [
    'page_title' => 'Login | TicketFlow'
]);
?>