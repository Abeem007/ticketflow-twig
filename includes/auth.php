<?php
// includes/auth.php - Auth Helpers

function isLoggedIn(): bool {
    return isset($_SESSION['user']);
}

function requireAuth(string $redirect = '/ticketflow-twig/auth/login'): void {
    if (!isLoggedIn()) {
        header("Location: $redirect");
        exit;
    }
}

function getCurrentUser(): ?array {
    return $_SESSION['user'] ?? null;
}
?>