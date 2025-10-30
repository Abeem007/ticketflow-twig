<?php
require_once 'config.php';
require_once 'includes/auth.php';

if (!isset($_SESSION['user'])) {
    header('Location: /ticketflow-twig/auth/login');
    exit;
}

// TODO: Fetch tickets from DB/localStorage via JS

echo $twig->render('tickets.twig', [
    'page_title' => 'Tickets | TicketFlow',
    'user' => $_SESSION['user'] ?? []
]);
?>