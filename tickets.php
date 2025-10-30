
<?php

require_once 'config.php';
echo $twig->render('tickets.twig', [
    'page'     => 'tickets',
    'base_url' => $baseUrl,
   
]);