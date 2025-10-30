
<?php
require_once __DIR__ . '/config.php';

echo $twig->render('landing.twig', [
    'page' => 'landing',
    'base_url' => $baseUrl
]);
?>
