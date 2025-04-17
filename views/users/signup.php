<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $image = trim($_POST['image']);

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required.";
    } elseif (strlen($username) < 3) {
        $errors[] = "Username must be at least 3 characters long.";
    }

    // Validate email
    if (empty($email)) {
        $errors[] = "Email is required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate password
    if (empty($password)) {
        $errors[] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters long.";
    }

    // If no errors, proceed with form submission
    if (empty($errors)) {
        header("Location: /users/signup/submit");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex justify-center items-center h-screen">
        <div class="bg-white shadow-lg rounded-lg p-8 max-w-md w-full">
            <h1 class="text-2xl font-bold text-center text-green-600 mb-6">Create an Account</h1>
            <?php if (!empty($errors)): ?>
                <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            <form action="" method="post">
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-medium">Username</label>
                    <input type="text" name="username" id="username" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" value="<?= htmlspecialchars($_POST['username'] ?? '') ?>" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium">Email</label>
                    <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-medium">Password</label>
                    <input type="password" name="password" id="password" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 font-medium">Profile Image URL</label>
                    <input type="text" name="image" id="image" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Optional" value="<?= htmlspecialchars($_POST['image'] ?? '') ?>">
                </div>
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Sign Up</button>
            </form>
            <p class="text-center text-gray-600 mt-4">Already have an account? <a href="/users/login" class="text-green-600 hover:underline">Log In</a></p>
        </div>
    </div>
</body>
</html>
