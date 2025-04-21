<?php
function renderContactForm() {
    include __DIR__ . '/../views/contact/index.php';
}

function submitContactForm() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        if (empty($name) || empty($email) || empty($message)) {
            $_SESSION['error'] = "All fields are required.";
            header("Location: /contact");
            exit;
        }

        // Simulate sending an email (replace this with actual email logic)
        $_SESSION['message'] = "Thank you, $name! Your message has been sent successfully.";
        header("Location: /contact");
        exit;
    }

    // Redirect to contact page if accessed via GET
    header("Location: /contact");
    exit;
}
