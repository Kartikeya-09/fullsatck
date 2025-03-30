<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in using PHPSESSID or a custom cookie
$isLoggedIn = isset($_SESSION['username']) && !empty($_SESSION['username']);
if (!$isLoggedIn && isset($_COOKIE['user_logged_in']) && $_COOKIE['user_logged_in'] === 'true') {
    $isLoggedIn = true;
}

// Check if the logged-in user is the demo user
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
    $productQuantity = $_POST['product_quantity'];

    // Add product to cart
    $_SESSION['cart'][$productId] = [
        'title' => $productTitle,
        'price' => $productPrice,
        'quantity' => ($_SESSION['cart'][$productId]['quantity'] ?? 0) + $productQuantity
    ];

    // Redirect to the cart page
    header("Location: /cart");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listing Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <?php if ($listing): ?>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden max-w-md mx-auto">
                <img src="<?= htmlspecialchars($listing['image']) ?>" alt="<?= htmlspecialchars($listing['title']) ?>" class="w-full h-96 object-cover">
                <div class="p-6">
                    <h1 class="text-3xl font-bold text-gray-800"><?= htmlspecialchars($listing['title']) ?></h1>
                    <p class="text-gray-600 mt-4"><?= htmlspecialchars($listing['description']) ?></p>
                    <p class="text-gray-800 font-bold text-xl mt-6">$<span id="product-price"><?= htmlspecialchars($listing['price']) ?></span></p>
                    <p class="text-sm text-gray-500 mt-2">Category: <?= htmlspecialchars($listing['category']) ?></p>
                    <div class="mt-6 flex items-center space-x-4">
                        <button id="decrease-quantity" class="bg-gray-300 text-gray-800 px-3 py-1 rounded hover:bg-gray-400">-</button>
                        <input type="number" id="product-quantity" value="1" min="1" class="w-16 text-center border border-gray-300 rounded">
                        <button id="increase-quantity" class="bg-gray-300 text-gray-800 px-3 py-1 rounded hover:bg-gray-400">+</button>
                    </div>
                    <p class="text-gray-800 font-bold text-lg mt-4">Total: $<span id="total-price"><?= htmlspecialchars($listing['price']) ?></span></p>
                    <div class="mt-6 flex space-x-4">
                        <form action="" method="post">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($listing['id']) ?>">
                            <input type="hidden" name="product_title" value="<?= htmlspecialchars($listing['title']) ?>">
                            <input type="hidden" name="product_price" value="<?= htmlspecialchars($listing['price']) ?>">
                            <input type="hidden" id="hidden-quantity" name="product_quantity" value="1">
                            <button type="submit" name="add_to_cart" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Add to Cart</button>
                        </form>
                        <button class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600" onclick="redirectToQR()">Buy Now</button>
                        <?php if ($isDemoUser): ?>
                            <a href="/listings/<?= urlencode($listing['id']) ?>/edit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Edit</a>
                            <form action="/listings/<?= urlencode($listing['id']) ?>?_method=DELETE" method="post" style="display:inline;">
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="bg-red-100 text-red-800 text-center p-4 rounded">
                Listing not found.
            </div>
        <?php endif; ?>
    </div>

    <script>
        const priceElement = document.getElementById('product-price');
        const quantityInput = document.getElementById('product-quantity');
        const totalPriceElement = document.getElementById('total-price');
        const hiddenQuantityInput = document.getElementById('hidden-quantity');

        const increaseButton = document.getElementById('increase-quantity');
        const decreaseButton = document.getElementById('decrease-quantity');

        const updateTotalPrice = () => {
            const price = parseFloat(priceElement.textContent);
            const quantity = parseInt(quantityInput.value);
            const total = (price * quantity).toFixed(2);
            totalPriceElement.textContent = total;
            hiddenQuantityInput.value = quantity;
        };

        increaseButton.addEventListener('click', () => {
            quantityInput.value = parseInt(quantityInput.value) + 1;
            updateTotalPrice();
        });

        decreaseButton.addEventListener('click', () => {
            if (quantityInput.value > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
                updateTotalPrice();
            }
        });

        quantityInput.addEventListener('input', updateTotalPrice);

        function redirectToQR() {
            window.location.href = '/payment/qr';
        }
    </script>
</body>
</html>
