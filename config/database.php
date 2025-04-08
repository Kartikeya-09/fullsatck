<?php
$host = getenv('DB_HOST') ?: 'localhost';
$dbname = getenv('DB_NAME') ?: 'ecopower';
$username = getenv('DB_USER') ?: 'root';
$password = getenv('DB_PASS') ?: 'finalpass';
$port = getenv('DB_PORT') ?: '5432'; // Default PostgreSQL port

try {
    $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
