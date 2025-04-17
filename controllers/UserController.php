<?php
require_once __DIR__ . '/../models/UserModel.php';

function renderSignUpForm() {
    include __DIR__ . '/../views/users/signup.php';
}

function signUp() {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $image = $_POST['image'] ?: "https://via.placeholder.com/150"; // Default image if none provided

    UserModel::create(['username' => $username, 'email' => $email, 'password' => $password, 'image' => $image]);
    $_SESSION['message'] = "Sign up successful. Please log in.";
    header("Location: /users/login");
}

function renderLoginForm() {
    include __DIR__ . '/../views/users/login.php';
}

function login() {
    // Ensure no output is sent before header() calls
    ob_start();

    // Check if email and password are set in the POST request
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$email || !$password) {
        $_SESSION['error'] = "Email and password are required.";
        header("Location: /users/login");
        exit;
    }

    $user = UserModel::findByEmail($email);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        setcookie("user_logged_in", "true", time() + 3600, "/"); // Set custom cookie for 1 hour
        $_SESSION['message'] = "Login successful.";
        header("Location: /listings");
    } else {
        $_SESSION['error'] = "Invalid email or password.";
        header("Location: /users/login");
    }

    ob_end_flush(); // Ensure output buffering is flushed
    exit;
}

function logout() {
    session_destroy();
    setcookie("user_logged_in", "", time() - 3600, "/"); // Clear the custom cookie
    $_SESSION['message'] = "Logout successful.";
    header("Location: /"); // Redirect to the root
    exit;
}

function renderLandingPage() {
    include __DIR__ . '/../views/listings/landing.php';
}
