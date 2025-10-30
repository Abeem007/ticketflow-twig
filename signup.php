<?php
require_once 'config.php';
require_once 'includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TODO: Real signup (e.g., hash password, insert DB)
    $_SESSION['user'] = ['email' => $_POST['email'] ?? ''];
    header('Location: /ticketflow-twig/dashboard');
    exit;
}

echo $twig->render('signup.twig', [
    'page_title' => 'Sign Up | TicketFlow'
]);
?>