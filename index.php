<?php
// index.php - Full Router for TicketFlow Twig App
require_once 'config.php';
require_once 'includes/auth.php';

// Get current path (clean URI)
$requestUri = $_SERVER['REQUEST_URI'];
$path = parse_url($requestUri, PHP_URL_PATH);

// Handle POST requests (e.g., login/signup forms)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    if ($action === 'login') {
        // TODO: Real auth (e.g., DB check). For demo: use session
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $_SESSION['user'] = ['email' => $_POST['email'], 'name' => 'Demo User'];
            header('Location: ' . ($base_path ?? '') . '/dashboard');
            exit;
        }
    } elseif ($action === 'signup') {
        // TODO: Real signup
        if (!empty($_POST['email'])) {
            $_SESSION['user'] = ['email' => $_POST['email'], 'name' => $_POST['name'] ?? 'New User'];
            header('Location: ' . ($base_path ?? '') . '/dashboard');
            exit;
        }
    }
    // If auth fails, redirect to login with error (handled in JS for UX)
    header('Location: ' . ($base_path ?? '') . '/auth/login?error=1');
    exit;
}

// Route based on path
switch ($path) {
    case '/':
    case '/index.php':
        echo $twig->render('landing.twig', ['page_title' => 'TicketFlow - Home']);
        break;

    case '/auth/login':
        echo $twig->render('login.twig', [
            'page_title' => 'Login | TicketFlow',
            'error' => $_GET['error'] ?? null
        ]);
        break;

    case '/auth/signup':
        echo $twig->render('signup.twig', [
            'page_title' => 'Sign Up | TicketFlow',
            'error' => $_GET['error'] ?? null
        ]);
        break;

    case '/dashboard':
        requireAuth(); // From includes/auth.php
        echo $twig->render('dashboard.twig', [
            'page_title' => 'Dashboard | TicketFlow',
            'user' => getCurrentUser()
        ]);
        break;

    case '/tickets':
        requireAuth();
        echo $twig->render('tickets.twig', [
            'page_title' => 'Tickets | TicketFlow',
            'user' => getCurrentUser()
        ]);
        break;

    case '/logout':
        session_destroy();
        header('Location: ' . ($base_path ?? '') . '/');
        exit;

    default:
        http_response_code(404);
        echo $twig->render('404.twig', [
            'page_title' => '404 - Not Found | TicketFlow',
            'path' => $path
        ]);
        break;
}
?>