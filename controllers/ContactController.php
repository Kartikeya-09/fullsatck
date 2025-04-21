<?php
function renderContactForm() {
    include __DIR__ . '/../views/contact/index.php';
}

function submitContactForm() {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (empty($name) || empty($email) || empty($message)) {
        $_SESSION['error'] = "All fields are required.";
        header("Location: /contact");
        exit;
    }

    // Simulate sending an email (you can replace this with actual email logic)
    $_SESSION['message'] = "Thank you, $name! Your message has been sent successfully.";
    header("Location: /contact");
    exit;
}
