<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <?php if ($listing): ?>
            <h1 class="text-center"><?= htmlspecialchars($listing->title) ?></h1>
            <div class="card mt-4">
                <img src="<?= htmlspecialchars($listing->image) ?>" class="card-img-top" alt="<?= htmlspecialchars($listing->title) ?>">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($listing->title) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($listing->description) ?></p>
                    <p class="card-text"><strong>Price:</strong> $<?= htmlspecialchars($listing->price) ?></p>
                    <p class="card-text"><strong>Category:</strong> <?= htmlspecialchars($listing->category) ?></p>
                </div>
            </div>
            <a href="/listings/<?= urlencode($listing->id) ?>/edit" class="btn btn-primary mt-3">Edit this listing</a>
            <form action="/listings/<?= urlencode($listing->id) ?>?_method=DELETE" method="post" style="display:inline;">
                <button type="submit" class="btn btn-danger mt-3">Delete this listing</button>
            </form>
            <button class="btn btn-success mt-3" onclick="checkLogin()">Buy Now</button>
            <script>
                function checkLogin() {
                    const token = document.cookie.split('; ').find(row => row.startsWith('token='));
                    if (token) {
                        window.location.href = '/payment/qr';
                    } else {
                        alert('You must be logged in to access the Buy Now feature.');
                    }
                }
            </script>
        <?php else: ?>
            <div class="alert alert-danger text-center">
                Listing not found.
            </div>
        <?php endif; ?>
    </div>

    <!-- ✅ Bootstrap JS (Optional) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
