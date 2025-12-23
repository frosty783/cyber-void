<?php
// Load FileLoader
require_once 'FileLoader.php';

$fileLoader = new FileLoader();

// Simple routing
$request = $_SERVER['REQUEST_URI'];
$base_path = '/';

// Remove query string
$request = strtok($request, '?');

// Route mapping - SIMPLE VERSION
$routes = [
    '/' => 'home.php',
    '/debug' => 'debug.php',
    '/classes' => 'classes.php',
    '/classes/(\d+)' => 'class_detail.php',
    '/challenges' => 'challenges.php',
    '/challenges/(\d+)' => 'challenge_detail.php',
    '/tips' => 'tips.php',
];

// Find matching route
$template = '404.php';
$params = [];

foreach ($routes as $route => $templateFile) {
    // Convert route to regex pattern
    $pattern = '#^' . str_replace('/', '\/', $route) . '$#';
    
    if (preg_match($pattern, $request, $matches)) {
        $template = $templateFile;
        array_shift($matches); // Remove full match
        $params = $matches; // Capture groups
        break;
    }
}

// Include header
include 'templates/header.php';

// Include the requested template
if (file_exists("templates/$template")) {
    include "templates/$template";
} else {
    include 'templates/404.php';
}

// Include footer
include 'templates/footer.php';
?>