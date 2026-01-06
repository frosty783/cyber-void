<?php
// Load FileLoader
require_once 'FileLoader.php';

$fileLoader = new FileLoader();

// Simple routing
$request = $_SERVER['REQUEST_URI'];
$base_path = '/';

// Remove query string
$request = strtok($request, '?');

// ======== HANDLE API ROUTES FIRST ========
if ($request === '/api/dashboard') {
    // Direct API response without templates
    header('Content-Type: application/json');
    
    // Get all data for dashboard
    $classes = $fileLoader->getClasses();
    $challenges = $fileLoader->getChallenges();

    // Count challenges by difficulty
    $difficultyCount = ['easy' => 0, 'medium' => 0, 'hard' => 0];
    foreach ($challenges as $challenge) {
        $diff = $challenge['difficulty'] ?? 'easy';
        if (isset($difficultyCount[$diff])) {
            $difficultyCount[$diff]++;
        }
    }

    // Prepare response
    $response = [
        'status' => 'success',
        'data' => [
            'total_classes' => count($classes),
            'total_challenges' => count($challenges),
            'difficulty_distribution' => $difficultyCount,
            'last_updated' => date('Y-m-d H:i:s'),
            'server_time' => time()
        ]
    ];

    echo json_encode($response);
    exit;
}
// ======== END API ROUTES ========

// Route mapping for regular pages
$routes = [
    '/' => 'home.php',
    '/debug' => 'debug.php',
    '/classes' => 'classes.php',
    '/classes/(\d+)' => 'class_detail.php',
    '/challenges' => 'challenges.php',
    '/challenges/(\d+)' => 'challenge_detail.php',
    '/tips' => 'tips.php',
    '/terminal' => 'terminal.php',
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