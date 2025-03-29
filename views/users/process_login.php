<?php
session_start();
require_once '../../models/user.js'; // Corrected path for UserModel

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    try {
        // Fetch the user from the database
        $user = UserModel::findByEmail($email); // Replace with your actual method to fetch user by email
        if (!$user || !password_verify($password, $user['password'])) {
            $_SESSION['error'] = "Invalid email or password.";
            header("Location: /users/login");
            exit;
        }

        // Generate a token
        $token = bin2hex(random_bytes(16)); // Generate a secure random token
        setcookie("token", $token, time() + 3600, "/", "", true, true); // Expires in 1 hour, Secure & HttpOnly

        // Store user details in the session
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];

        $_SESSION['message'] = "Login successful.";
        header("Location: /listings");
        exit;
    } catch (Exception $e) {
        $_SESSION['error'] = "Something went wrong: " . $e->getMessage();
        header("Location: /users/login");
        exit;
    }
} else {
    header("Location: /users/login");
    exit;
}
