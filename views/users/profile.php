<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['email'])) {
    header("Location: /users/login");
    exit;
}

require_once __DIR__ . '/../../models/UserModel.php';

$user = UserModel::findByEmail($_SESSION['email']);
if (!$user) {
    echo "User not found.";
    exit;
}

// Set a default image URL if the user's image is empty, null, or the key doesn't exist
$defaultImage = "https://images.unsplash.com/photo-1546961329-78bef0414d7c?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTJ8fHVzZXJ8ZW58MHx8MHx8fDA%3D";
$userImage = isset($user['image']) && $user['image'] ? $user['image'] : $defaultImage;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $newPassword = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
    UserModel::updatePassword($_SESSION['email'], $newPassword);
    $_SESSION['message'] = "Password updated successfully.";
    header("Location: /users/profile");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_image'])) {
    $image = $_POST['image'] ?: $defaultImage; // Ensure default image URL is set
    UserModel::updateImage($_SESSION['email'], $image);
    $_SESSION['message'] = "Profile image updated successfully.";
    header("Location: /users/profile");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">User Profile</h1>
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['message']) ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
        <div class="card mx-auto" style="max-width: 400px;">
            <img src="<?= htmlspecialchars($userImage) ?>" class="card-img-top" alt="Profile Image">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($user['username']) ?></h5>
                <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <form action="" method="post" class="mb-3">
                    <label for="image" class="form-label">Update Profile Image</label>
                    <input type="text" name="image" id="image" class="form-control mb-2" placeholder="Enter image URL">
                    <button type="submit" name="update_image" class="btn btn-primary">Update Image</button>
                </form>
                <form action="" method="post">
                    <label for="new_password" class="form-label">Change Password</label>
                    <input type="password" name="new_password" id="new_password" class="form-control mb-2" required>
                    <button type="submit" name="change_password" class="btn btn-warning">Change Password</button>
                </form>
                <div class="mt-4 text-center">
                    <a href="/listings" class="btn btn-secondary">Go to Listings</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
