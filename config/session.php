<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 3600, // 1 hour
        'cookie_secure' => true,
        'cookie_httponly' => true,
        'cookie_samesite' => 'Strict',
        'name' => 'ECOPOWER_SESSION',
        'hash_function' => 'sha256',
        'hash_bits_per_character' => 5,
    ]);
}

$sessionSecret = getenv('SESSION_SECRET') ?: 'default_secret_key';
if (!isset($_SESSION['secret'])) {
    $_SESSION['secret'] = $sessionSecret;
}
