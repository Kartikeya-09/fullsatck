<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in using PHPSESSID or a custom cookie
$isLoggedIn = isset($_SESSION['username']) && !empty($_SESSION['username']);
if (!$isLoggedIn && isset($_COOKIE['user_logged_in']) && $_COOKIE['user_logged_in'] === 'true') {
    $isLoggedIn = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Power Solution</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans">

    <!-- Navbar -->
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-green-600">Eco Power Solution</a>
            <div class="space-x-4">
                <a href="#about" class="text-gray-700 hover:text-green-600">About Us</a>
                <a href="#products" class="text-gray-700 hover:text-green-600">Products</a>
                <a href="#faq" class="text-gray-700 hover:text-green-600">FAQ</a>
                <?php if ($isLoggedIn): ?>
                    <a href="/users/profile" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Profile</a>
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

    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-400 to-blue-500 text-white text-center py-20">
        <div class="container mx-auto">
            <h1 class="text-5xl font-bold mb-4">Welcome to Eco Power Solution</h1>
            <p class="text-lg mb-6">Your Smart Home Revolution Starts Here</p>
            <a href="/listings" class="bg-white text-green-600 px-6 py-3 rounded-full font-bold hover:bg-gray-100">Explore Products</a>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-16 bg-gray-50">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">About Us</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                At Eco Power Solution, we create innovative smart home solutions that blend convenience with energy efficiency. 
                Our mission is to make your home smarter, safer, and more sustainable.
            </p>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Our Products</h2>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto mb-8">
                Explore our range of smart home devices, including smart lights, security cameras, and voice assistants.
            </p>
            <a href="/listings" class="bg-green-500 text-white px-6 py-3 rounded-full font-bold hover:bg-green-600">View All Products</a>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-16 bg-gray-50">
        <div class="container mx-auto text-center">
            <h2 class="text-4xl font-bold text-gray-800 mb-6">Frequently Asked Questions</h2>
            <div class="max-w-3xl mx-auto space-y-4">
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800">What is Eco Power Solution?</h3>
                    <p class="text-gray-600 mt-2">Eco Power Solution provides smart home automation systems to make your life easier and more efficient.</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-800">How do I install smart devices?</h3>
                    <p class="text-gray-600 mt-2">Our smart devices are easy to install via Wi-Fi or Bluetooth and come with detailed instructions.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="container mx-auto text-center">
            <p>© 2025 Eco Power Solution | All Rights Reserved</p>
            <p>Follow us on 
                <a href="#" class="text-blue-400 hover:underline">Facebook</a>, 
                <a href="#" class="text-blue-400 hover:underline">Twitter</a>, and 
                <a href="#" class="text-blue-400 hover:underline">Instagram</a>.
            </p>
        </div>
    </footer>

</body>
</html>