<?php
require_once __DIR__ . '/../middlewares/auth.php'; // Include the isLoggedIn middleware

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

$router = new Router();
$router->get('/qr', 'isLoggedIn', 'serveQRImage'); // Serve the QR image

return $router;
