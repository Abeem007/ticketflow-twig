
<?php
require_once __DIR__ . '/config.php';


echo $twig->render('dashboard.twig', [
    'page'     => 'dashboard',
    'base_url' => $baseUrl,
    
]);