<?php
require_once __DIR__ . '/../models/UserModel.php';

function renderSignUpForm() {
    include __DIR__ . '/../views/users/signup.php';
}

function signUp() {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $image = $_POST['image'] ?: "https://via.placeholder.com/150"; // Default image if none provided

    // Validate password (must be exactly 6 digits)
    if (!preg_match('/^\d{6}$/', $password)) {
        $_SESSION['error'] = "Password must be exactly 6 digits.";
        header("Location: /users/signup");
        exit;
    }

    // Hash the password and create the user
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    UserModel::create(['username' => $username, 'email' => $email, 'password' => $hashedPassword, 'image' => $image]);
    $_SESSION['message'] = "Sign up successful. Please log in.";
    header("Location: /users/login");
}

function renderLoginForm() {
    include __DIR__ . '/../views/users/login.php';
}

function login() {
    $email = $_POST['email'];
    $password = $_POST['password'];

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
