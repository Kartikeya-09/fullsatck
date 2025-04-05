<?php
require_once __DIR__ . '/../controllers/UserController.php';
require_once __DIR__ . '/../controllers/ListingController.php';
require_once __DIR__ . '/../controllers/CategoryController.php';
require_once __DIR__ . '/../middlewares/auth.php'; // Include the auth middleware

function getRoutes() {
    return [
        // Root route
        '/' => 'renderLandingPage',

        // User routes
        '/users/signup' => 'renderSignUpForm',
        '/users/signup/submit' => 'signUp',
        '/users/login' => 'renderLoginForm',
        '/users/login/submit' => 'login',
        '/users/logout' => 'logout',
        '/users/profile' => function () {
            include __DIR__ . '/../views/users/profile.php';
        },

        // Listing routes
        '/listings' => 'indexListings',
        '/listings/new' => function () {
            restrictToDemoUser();
            renderNewListingForm();
        },
        '/listings/create' => function () {
            restrictToDemoUser();
            addNewListing();
        },
        '/listings/{id}/edit' => function () {
            restrictToDemoUser();
            renderEditListingForm();
        },
        '/listings/update' => function () {
            restrictToDemoUser();
            editListing();
        },
        '/listings/delete' => function () {
            restrictToDemoUser();
            deleteListing();
        },
        '/listings/{id}' => 'showIndividualListing', // Route for individual listing

        // Category routes
        '/categories/Switch%20Modular%20and%20Luxury' => 'showCategoryListings',
        '/categories/Wires' => 'showCategoryListings',
        '/categories/Camera%20Dom%20and%20Bullet' => 'showCategoryListings',
        '/categories/Motorised%20Gate%20and%20Curtain' => 'showCategoryListings',
        '/categories/Home%20Theater%20and%20Audio' => 'showCategoryListings',
        '/categories/Fans' => 'showCategoryListings',
        '/categories/Solar%20Panel' => 'showCategoryListings',

        // Cart route
        '/cart' => function () {
            include __DIR__ . '/../views/cart/index.php';
        },

        // Payment routes
        '/payment/qr' => 'serveQRImage', // Route to serve the QR image
    ];
}

function serveQRImage() {
    $qrImagePath = __DIR__ . '/../public/qr.jpeg'; // Path to the QR image
    if (file_exists($qrImagePath)) {
        header('Content-Type: image/jpeg');
        readfile($qrImagePath);
        exit;
    } else {
        http_response_code(404);
        echo "QR image not found.";
        exit;
    }
}
