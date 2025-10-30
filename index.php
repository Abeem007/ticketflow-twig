<?php
require_once '../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new \Twig\Environment($loader);

// Simple router
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
  case '/':
    echo $twig->render('landing.twig');
    break;
  case '/auth/login':
    echo $twig->render('login.twig');
    break;
  case '/auth/signup':
    echo $twig->render('signup.twig');
    break;
  case '/dashboard':
    echo $twig->render('dashboard.twig');
    break;
  case '/tickets':
    echo $twig->render('tickets.twig');
    break;
  default:
    http_response_code(404);
    echo $twig->render('404.twig', ['path' => $uri]);
    break;
}
