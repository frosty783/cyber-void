<?php
header('Content-Type: application/json');
require_once '../FileLoader.php';

$loader = new FileLoader();
$response = [];

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

// Get recent challenges (last 5)
$recentChallenges = array_slice($challenges, 0, 5);

// Prepare response
$response = [
    'status' => 'success',
    'data' => [
        'total_classes' => count($classes),
        'total_challenges' => count($challenges),
        'difficulty_distribution' => $difficultyCount,
        'recent_challenges' => $recentChallenges,
        'last_updated' => date('Y-m-d H:i:s'),
        'server_time' => time()
    ]
];

echo json_encode($response);
?>