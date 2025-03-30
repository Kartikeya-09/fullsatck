<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Ensure $listing is available and valid
if (!isset($listing) || empty($listing)) {
    http_response_code(404);
    echo "Listing not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Listing</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">Edit Listing</h1>
        <form action="/listings/update" method="post">
            <input type="hidden" name="_method" value="PUT"> <!-- Use PUT method -->
            <input type="hidden" name="id" value="<?= htmlspecialchars($listing['id'] ?? '') ?>"> <!-- Pass the listing ID -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($listing['title'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control" required><?= htmlspecialchars($listing['description'] ?? '') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" name="price" id="price" class="form-control" value="<?= htmlspecialchars($listing['price'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select name="category" id="category" class="form-select" required>
                    <option value="Switch Modular and Luxury" <?= (isset($listing['category']) && $listing['category'] === "Switch Modular and Luxury") ? "selected" : "" ?>>Switch Modular and Luxury</option>
                    <option value="Wires" <?= (isset($listing['category']) && $listing['category'] === "Wires") ? "selected" : "" ?>>Wires</option>
                    <option value="Camera Dom and Bullet" <?= (isset($listing['category']) && $listing['category'] === "Camera Dom and Bullet") ? "selected" : "" ?>>Camera Dom and Bullet</option>
                    <option value="Motorised Gate and Curtain" <?= (isset($listing['category']) && $listing['category'] === "Motorised Gate and Curtain") ? "selected" : "" ?>>Motorised Gate and Curtain</option>
                    <option value="Home Theater and Audio" <?= (isset($listing['category']) && $listing['category'] === "Home Theater and Audio") ? "selected" : "" ?>>Home Theater and Audio</option>
                    <option value="Fans" <?= (isset($listing['category']) && $listing['category'] === "Fans") ? "selected" : "" ?>>Fans</option>
                    <option value="Solar Panel" <?= (isset($listing['category']) && $listing['category'] === "Solar Panel") ? "selected" : "" ?>>Solar Panel</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input type="text" name="image" id="image" class="form-control" value="<?= htmlspecialchars($listing['image'] ?? '') ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update Listing</button>
        </form>
    </div>
</body>
</html>
