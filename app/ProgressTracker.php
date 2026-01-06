<?php

class ProgressTracker {
    private $dataFile;
    
    public function __construct() {
        $this->dataFile = dirname(__DIR__) . '/data/progress.json';
        $this->ensureDataFile();
    }
    
    private function ensureDataFile() {
        if (!file_exists(dirname($this->dataFile))) {
            mkdir(dirname($this->dataFile), 0755, true);
        }
        
        if (!file_exists($this->dataFile)) {
            file_put_contents($this->dataFile, json_encode([
                'users' => [],
                'challenges_completed' => [],
                'classes_completed' => []
            ]));
        }
    }
    
    public function markChallengeComplete($userId, $challengeId, $points) {
        $data = $this->loadData();
        
        if (!isset($data['challenges_completed'][$userId])) {
            $data['challenges_completed'][$userId] = [];
        }
        
        $data['challenges_completed'][$userId][$challengeId] = [
            'completed_at' => date('Y-m-d H:i:s'),
            'points' => $points
        ];
        
        $this->saveData($data);
        return true;
    }
    
    public function markClassComplete($userId, $classId) {
        $data = $this->loadData();
        
        if (!isset($data['classes_completed'][$userId])) {
            $data['classes_completed'][$userId] = [];
        }
        
        $data['classes_completed'][$userId][$classId] = [
            'completed_at' => date('Y-m-d H:i:s')
        ];
        
        $this->saveData($data);
        return true;
    }
    
    public function getUserProgress($userId) {
        $data = $this->loadData();
        
        $challenges = $data['challenges_completed'][$userId] ?? [];
        $classes = $data['classes_completed'][$userId] ?? [];
        
        return [
            'challenges_completed' => count($challenges),
            'classes_completed' => count($classes),
            'total_points' => array_sum(array_column($challenges, 'points')),
            'challenges' => $challenges,
            'classes' => $classes
        ];
    }
    
    public function getAllProgress() {
        $data = $this->loadData();
        
        $stats = [
            'total_challenges_completed' => 0,
            'total_classes_completed' => 0,
            'total_points_earned' => 0,
            'active_users' => 0
        ];
        
        foreach ($data['challenges_completed'] as $userChallenges) {
            $stats['total_challenges_completed'] += count($userChallenges);
            $stats['total_points_earned'] += array_sum(array_column($userChallenges, 'points'));
        }
        
        foreach ($data['classes_completed'] as $userClasses) {
            $stats['total_classes_completed'] += count($userClasses);
        }
        
        $stats['active_users'] = count(array_unique(
            array_merge(
                array_keys($data['challenges_completed']),
                array_keys($data['classes_completed'])
            )
        ));
        
        return $stats;
    }
    
    private function loadData() {
        $content = file_get_contents($this->dataFile);
        return json_decode($content, true);
    }
    
    private function saveData($data) {
        file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }
}