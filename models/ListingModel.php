<?php
require_once __DIR__ . '/../config/database.php';

class ListingModel {
    public static function findAll() {
        global $pdo;
        $stmt = $pdo->query("SELECT * FROM listings");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function findById($id) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM listings WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function create($data) {
        global $pdo;
        $stmt = $pdo->prepare("INSERT INTO listings (title, description, image, price, category) VALUES (:title, :description, :image, :price, :category)");
        $stmt->execute($data);
        return $pdo->lastInsertId();
    }

    public static function update($id, $data) {
        global $pdo;
        $stmt = $pdo->prepare("UPDATE listings SET title = :title, description = :description, image = :image, price = :price, category = :category WHERE id = :id");
        $data['id'] = $id;
        $stmt->execute($data);
    }

    public static function delete($id) {
        global $pdo;
        $stmt = $pdo->prepare("DELETE FROM listings WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public static function findAllByCategory($category) {
        global $pdo;
        $stmt = $pdo->prepare("SELECT * FROM listings WHERE category = :category");
        $stmt->execute(['category' => $category]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
