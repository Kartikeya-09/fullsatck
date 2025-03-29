<?php
session_start();

// Debugging: Check if the token cookie is accessible
var_dump($_COOKIE); // Outputs all cookies, including the token

// Check if the user is logged in
$isLoggedIn = isset($_COOKIE['token']) && !empty($_COOKIE['token']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco Power Solution</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        /* Smooth Gradient Background */
        .hero {
            background: linear-gradient(to right, #3b82f6, #10b981);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        /* Glowing Effect */
        .title {
            font-size: 4rem;
            font-weight: bold;
            color: white;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.8);
            opacity: 0;
        }

        .subtitle {
            font-size: 2rem;
            font-weight: bold;
            color: #ffffff;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
            opacity: 0;
        }

        /* Floating Animation */
        .float {
            animation: floating 3s infinite ease-in-out;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        /* Hover Button Animation */
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 30px;
            font-size: 1.2rem;
            color: white;
            background: linear-gradient(45deg, #ff416c, #ff4b2b);
            border: none;
            border-radius: 50px;
            box-shadow: 0 4px 10px rgba(255, 75, 75, 0.5);
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .btn:hover {
            transform: scale(1.1);
            box-shadow: 0 10px 20px rgba(255, 75, 75, 0.8);
        }

        /* Navigation Bar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(5px);
            z-index: 100;
        }

        .navbar a {
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            text-transform: uppercase;
            margin-right: 20px;
            transition: 0.3s;
        }

        .navbar a:hover {
            color: #ff4b2b;
        }

    </style>
</head>
<body class="font-sans bg-black">

    <!-- Debugging: Display the token in the browser console -->
    <script>
        console.log("document.cookie:", document.cookie); // Logs all cookies in the browser console
    </script>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div>
            <a href="#about">About Us</a>
            <a href="#products">Products</a>
            <a href="#faq">FAQ</a>
        </div>
        <div>
            <?php if ($isLoggedIn): ?>
                <form action="/users/logout" method="post" style="display:inline;">
                    <button type="submit" class="btn btn-danger me-2">Logout</button>
                </form>
            <?php else: ?>
                <a href="/users/login" class="btn btn-primary me-2">Login</a>
                <a href="/users/signup" class="btn btn-secondary">Sign Up</a>
            <?php endif; ?>
        </div>
    </nav>

    <!-- Success Message -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success text-center mt-3">
            <?= htmlspecialchars($_SESSION['message']) ?>
        </div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- Hero Section -->
    <section class="hero">
        <h1 class="title" id="ecoTitle">Eco Power Solution</h1>
        <p class="subtitle">
            <span id="typing"></span>
        </p>
        <button class="btn" onclick="window.location.href='/listings'">Get Started</button>
    </section>

    <!-- About Us & Products -->
    <section class="py-16 px-8 bg-gray-900 flex flex-wrap justify-center gap-6 text-white">
        <div id="about" class="bg-gray-800 shadow-lg rounded-lg p-6 max-w-lg w-full md:w-1/2">
            <h2 class="text-3xl font-bold">About Us</h2>
            <p class="text-lg mt-4">
                We create innovative smart home solutions that blend convenience with energy efficiency.
            </p>
        </div>

        <div id="products" class="bg-gray-800 shadow-lg rounded-lg p-6 max-w-lg w-full md:w-1/2">
            <h2 class="text-3xl font-bold">Our Products</h2>
            <p class="text-lg mt-4">
                Explore our smart home devices, including smart lights, security cameras, and voice assistants.
            </p>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-16 px-8 bg-gray-800 text-white">
        <h2 class="text-4xl font-bold text-center">Frequently Asked Questions</h2>
        <div class="mt-8 max-w-3xl mx-auto space-y-4">
            <div class="border border-gray-700 rounded-lg shadow-lg p-4">
                <button class="w-full text-left font-semibold text-lg focus:outline-none toggle-faq">What is Eco Power Solution?</button>
                <p class="hidden mt-2 text-gray-400">Eco Power Solution provides smart home automation systems.</p>
            </div>
            <div class="border border-gray-700 rounded-lg shadow-lg p-4">
                <button class="w-full text-left font-semibold text-lg focus:outline-none toggle-faq">How do I install smart devices?</button>
                <p class="hidden mt-2 text-gray-400">Our smart devices are easy to install via Wi-Fi or Bluetooth.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-6 bg-black text-center text-gray-400">
        <p>© 2025 Eco Power Solution | All Rights Reserved</p>
    </footer>

    <!-- JavaScript Animations -->
    <script>
        // Smooth Title Appearance
        gsap.to(".title", { opacity: 1, duration: 1.5, y: -20 });

        // Smooth Subtitle Animation
        gsap.to(".subtitle", { opacity: 1, duration: 2, y: -10, delay: 1 });

        // Typewriter Effect for Subtitle
        new Typed("#typing", {
            strings: ["Your Smart Home Revolution Starts Here...", "Experience Energy Efficiency Like Never Before!"],
            typeSpeed: 50,
            backSpeed: 30,
            loop: true
        });

        // FAQ Toggle
        document.querySelectorAll('.toggle-faq').forEach(button => {
            button.addEventListener('click', () => {
                const answer = button.nextElementSibling;
                answer.classList.toggle('hidden');
            });
        });
    </script>

</body>
</html>