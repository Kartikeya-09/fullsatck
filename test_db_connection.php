<?php
require_once __DIR__ . '/config/database.php';

try {
    $stmt = $pdo->query("SELECT 1");
    echo "Database connection successful!";
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
