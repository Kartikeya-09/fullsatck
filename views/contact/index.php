<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-10">
        <h1 class="text-center text-4xl font-bold mb-8">📞 Contact Us</h1>
        <div class="bg-white shadow-md rounded-lg p-6 max-w-2xl mx-auto">
            <p class="text-gray-600 mb-6">
                Have questions or need assistance? Feel free to reach out to us using the form below, and we'll get back to you as soon as possible.
            </p>
            <form action="/contact/submit" method="post">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium">Your Name</label>
                    <input type="text" name="name" id="name" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-medium">Your Email</label>
                    <input type="email" name="email" id="email" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required>
                </div>
                <div class="mb-4">
                    <label for="message" class="block text-gray-700 font-medium">Your Message</label>
                    <textarea name="message" id="message" rows="5" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-500" required></textarea>
                </div>
                <button type="submit" class="w-full bg-green-500 text-white py-2 rounded hover:bg-green-600">Send Message</button>
            </form>
        </div>
        <div class="mt-6 text-center">
            <a href="/" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">Back to Home</a>
        </div>
    </div>
</body>
</html>
