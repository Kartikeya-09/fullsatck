<?php
require_once __DIR__ . '/../config/database.php';

class UserModel {
    public static function findByEmail($email) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password, image) VALUES (:username, :email, :password, :image)");
        $stmt->execute($data);
        return $pdo->lastInsertId();
    }

    public static function updatePassword($email, $newPassword) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE email = :email");
        $stmt->execute(['password' => $newPassword, 'email' => $email]);
    }

    public static function updateImage($email, $image) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE users SET image = :image WHERE email = :email");
        $stmt->execute(['image' => $image, 'email' => $email]);
    }
}
