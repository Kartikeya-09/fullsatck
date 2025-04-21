<?php
function isDemoUser() {
    return isset($_SESSION['email']) && $_SESSION['email'] === 'demo@gmail.com';
}

function restrictToDemoUser() {
    if (!isDemoUser()) {
        http_response_code(403);
        echo "Access denied. Only the demo user can perform this action.";
        exit;
    }
}

function isLoggedIn() {
    return isset($_SESSION['email']) && !empty($_SESSION['email']);
}
