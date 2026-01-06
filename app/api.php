<?php
// app/api.php - Direct API endpoint
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Only handle API requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

// Check if it's a dashboard request
if ($_SERVER['REQUEST_URI'] === '/api/dashboard' || $_SERVER['REQUEST_URI'] === '/api/dashboard/') {
    require_once 'FileLoader.php';
    
    try {
        $loader = new FileLoader();
        
        // Get all data for dashboard
        $classes = $loader->getClasses();
        $challenges = $loader->getChallenges();

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
        
    } catch (Exception $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to load dashboard data'
        ]);
        exit;
    }
}

// If not dashboard API, return 404
http_response_code(404);
echo json_encode(['status' => 'error', 'message' => 'API endpoint not found']);
?>