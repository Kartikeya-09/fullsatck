<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Handle removing from cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $productId = $_POST['product_id'];
    unset($_SESSION['cart'][$productId]); // Remove the item from the cart
}

// Calculate total price
$totalPrice = array_reduce($_SESSION['cart'] ?? [], function ($total, $product) {
    return $total + ($product['price'] * $product['quantity']);
}, 0);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-center text-4xl font-bold mb-8">🛒 Your Cart</h1>
        <div class="bg-white shadow-md rounded-lg p-6">
            <?php if (!empty($_SESSION['cart'])): ?>
                <ul class="space-y-4">
                    <?php foreach ($_SESSION['cart'] as $productId => $product): ?>
                        <li class="flex justify-between items-center">
                            <span><?= htmlspecialchars($product['title']) ?> (x<?= $product['quantity'] ?>)</span>
                            <span>$<?= htmlspecialchars($product['price'] * $product['quantity']) ?></span>
                            <form action="" method="post" class="inline">
                                <input type="hidden" name="product_id" value="<?= htmlspecialchars($productId) ?>">
                                <button type="submit" name="remove_from_cart" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Remove</button>
                            </form>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="mt-6 text-right font-bold text-xl">
                    Total: $<?= $totalPrice ?>
                </div>
                <div class="mt-6 text-center">
                    <a href="/payment/qr" class="bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600">Buy Now</a>
                </div>
            <?php else: ?>
                <p class="text-gray-500 text-center">Your cart is empty.</p>
            <?php endif; ?>
        </div>
        <div class="mt-6 text-center">
            <a href="/listings" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">Back to Listings</a>
        </div>
    </div>
</body>
</html>
