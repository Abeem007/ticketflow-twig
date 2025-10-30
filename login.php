<?php
require_once __DIR__ . '/config.php';

echo $twig->render('login.twig', [
    'page' => 'login',
    'base_url' => $baseUrl
]);
?>