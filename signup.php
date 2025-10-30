

<?php
session_start();
require_once 'vendor/autoload.php';
require_once 'config.php';


if (isset($_SESSION['user'])) {
  header('Location: /ticketflow-twig/dashboard.php');
  exit();
}

echo $twig->render('signup.twig', [
  'page' => 'signup'
]);
