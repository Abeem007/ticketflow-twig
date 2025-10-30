<?php
require_once 'config.php';

session_destroy();
header('Location: /ticketflow-twig/');
exit;
?>