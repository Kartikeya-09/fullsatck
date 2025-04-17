<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in using PHPSESSID or a custom cookie
$isLoggedIn = isset($_SESSION['username']) && !empty($_SESSION['username']);
if (!$isLoggedIn && isset($_COOKIE['user_logged_in']) && $_COOKIE['user_logged_in'] === 'true') {
    $isLoggedIn = true;
}

$isDemoUser = isset($_SESSION['email']) && $_SESSION['email'] === 'demo@gmail.com';

// Initialize cart if not already set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Handle adding to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $productId = $_POST['product_id'];
    $productTitle = $_POST['product_title'];
    $productPrice = $_POST['product_price'];

    // Add product to cart
    $_SESSION['cart'][$productId] = [
        'title' => $productTitle,
        'price' => $productPrice,
        'quantity' => ($_SESSION['cart'][$productId]['quantity'] ?? 0) + 1
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-green-600">Eco Power Solution</a>
            <div class="space-x-4">
                <a href="/cart" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    <i class="fas fa-shopping-cart"></i> Cart
                </a>
                <?php if ($isLoggedIn): ?>
                    <a href="/users/profile" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <form action="/users/logout" method="post" class="inline">
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
                    </form>
                <?php else: ?>
                    <a href="/users/login" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Login</a>
                    <a href="/users/signup" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Sign Up</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-10">
        <!-- <h1 class="text-center text-4xl font-bold mb-8">📋 Available Products</h1> -->

        <!-- Navigation
        <div class="flex justify-between items-center mb-6">
            <div>
                <a href="/cart" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    <i class="fas fa-shopping-cart"></i> View Cart
                </a>
            </div>
            <?php if ($isLoggedIn): ?>
                <div>
                    <a href="/users/profile" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        <i class="fas fa-user"></i> Profile
                    </a>
                </div>
            <?php endif; ?>
        </div> -->

        <!-- Display login/logout message -->
        <?php if ($isLoggedIn): ?>
            <div id="login-message" class="bg-green-100 text-green-800 text-center p-4 rounded mb-4">
                You are logged in as <?= htmlspecialchars($_SESSION['username'] ?? 'Guest') ?>.
            </div>
        <?php else: ?>
            <div class="bg-yellow-100 text-yellow-800 text-center p-4 rounded mb-4">
                You are not logged in. Please log in to access all features.
            </div>
        <?php endif; ?>

        <!-- Display error message -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-100 text-red-800 text-center p-4 rounded mb-4">
                <?= htmlspecialchars($_SESSION['error']) ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if ($isDemoUser): ?>
            <div class="text-center mb-6">
                <a href="/listings/new" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Create New Listing</a>
            </div>
        <?php endif; ?>

        <!-- Filters Section -->
        <div class="flex flex-wrap justify-center gap-4 mb-8">
            <a href="/categories/Switch%20Modular%20and%20Luxury" class="flex items-center bg-blue-100 text-blue-800 px-4 py-2 rounded shadow hover:bg-blue-200">
                <i class="fas fa-lightbulb mr-2"></i> Switch Modular and Luxury
            </a>
            <a href="/categories/Wires" class="flex items-center bg-green-100 text-green-800 px-4 py-2 rounded shadow hover:bg-green-200">
                <i class="fas fa-plug mr-2"></i> Wires
            </a>
            <a href="/categories/Camera%20Dom%20and%20Bullet" class="flex items-center bg-yellow-100 text-yellow-800 px-4 py-2 rounded shadow hover:bg-yellow-200">
                <i class="fas fa-video mr-2"></i> Camera Dom and Bullet
            </a>
            <a href="/categories/Motorised%20Gate%20and%20Curtain" class="flex items-center bg-purple-100 text-purple-800 px-4 py-2 rounded shadow hover:bg-purple-200">
                <i class="fas fa-door-closed mr-2"></i> Motorised Gate and Curtain
            </a>
            <a href="/categories/Home%20Theater%20and%20Audio" class="flex items-center bg-red-100 text-red-800 px-4 py-2 rounded shadow hover:bg-red-200">
                <i class="fas fa-music mr-2"></i> Home Theater and Audio
            </a>
            <a href="/categories/Fans" class="flex items-center bg-teal-100 text-teal-800 px-4 py-2 rounded shadow hover:bg-teal-200">
                <i class="fas fa-fan mr-2"></i> Fans
            </a>
            <a href="/categories/Solar%20Panel" class="flex items-center bg-orange-100 text-orange-800 px-4 py-2 rounded shadow hover:bg-orange-200">
                <i class="fas fa-solar-panel mr-2"></i> Solar Panel
            </a>
        </div>

        <!-- Product Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php if (!empty($allListings)): ?>
                <?php foreach ($allListings as $listing): ?>
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="<?= htmlspecialchars($listing['image']) ?>" alt="<?= htmlspecialchars($listing['title']) ?>" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-lg font-bold"><?= htmlspecialchars($listing['title']) ?></h2>
                            <p class="text-gray-600 mt-2"><?= htmlspecialchars($listing['description']) ?></p>
                            <p class="text-gray-800 font-bold mt-4">Rs <?= htmlspecialchars($listing['price']) ?></p>
                            <p class="text-sm text-gray-500 mt-1">Category: <?= htmlspecialchars($listing['category']) ?></p>
                            <div class="mt-4 flex justify-between items-center">
                                <a href="/listings/<?= urlencode($listing['id']) ?>" class="text-blue-500 hover:underline">View Details</a>
                                <form action="" method="post" class="inline">
                                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($listing['id']) ?>">
                                    <input type="hidden" name="product_title" value="<?= htmlspecialchars($listing['title']) ?>">
                                    <input type="hidden" name="product_price" value="<?= htmlspecialchars($listing['price']) ?>">
                                    <button type="submit" name="add_to_cart" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center text-gray-600">
                    No listings found.
                </div>
            <?php endif; ?>
        </div>
    </div>

      <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6 mt-10">
        <div class="container mx-auto text-center">
            <p>© 2025 Eco Power Solution | All Rights Reserved</p>
            <p>Follow us on 
                <a href="#" class="text-blue-400 hover:underline">Facebook</a>, 
                <a href="#" class="text-blue-400 hover:underline">Twitter</a>, and 
                <a href="#" class="text-blue-400 hover:underline">Instagram</a>.
            </p>
        </div>
    </footer>

    <script>
        // Hide the login message after 5 seconds
        const loginMessage = document.getElementById('login-message');
        if (loginMessage) {
            setTimeout(() => {
                loginMessage.style.display = 'none';
            }, 5000);
        }
    </script>
</body>
</html>
