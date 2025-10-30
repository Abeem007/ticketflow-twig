<?php
require_once __DIR__ . '/config.php';

echo $twig->render('signup.twig', [
    'page' => 'signup',
    'base_url' => $baseUrl
]);
?>