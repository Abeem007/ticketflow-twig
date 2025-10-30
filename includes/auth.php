
<?php


function requireLogin() {
    if (empty($_SESSION['ticketapp_session'])) {
        header('Location: /ticketflow-twig/login.php');
        exit;
    }
}