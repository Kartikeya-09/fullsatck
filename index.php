<?php
session_start();
require_once __DIR__ . '/routes/web.php'; // Include the routes file
require_once __DIR__ . '/config/database.php'; // Include the database configuration

// Parse the request URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Route handling
$routes = getRoutes(); // Get all defined routes

// Handle dynamic routes like /listings/{id}
foreach ($routes as $route => $handler) {
    $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route); // Replace {param} with regex
    if (preg_match("#^$pattern$#", $requestUri, $matches)) {
        array_shift($matches); // Remove the full match
        $_GET['id'] = $matches[0] ?? null; // Set the dynamic parameter (e.g., id)
        call_user_func($handler);
        exit;
    }
}

// Default 404 handler
http_response_code(404);
echo "404 Not Found";
