<?php

class FileLoader
{

    private $basePath;

    public function __construct($basePath = '')
    {
        // Always use the app folder directly
        $this->basePath = __DIR__;  // Points to app/ folder

        // Log for debugging
        error_log("FileLoader base path: " . $this->basePath);
        error_log("Classes path: " . $this->basePath . '/classes');
        error_log("Challenges path: " . $this->basePath . '/challenges');
    }

    /**
     * Get all classes
     */
    public function getClasses()
    {
        $classes = [];
        $classDir = $this->basePath . '/classes/';

        error_log("Looking for classes in: " . $classDir);

        if (!is_dir($classDir)) {
            error_log("Class directory not found: " . $classDir);
            return $classes;
        }

        $folders = scandir($classDir);
        error_log("Found folders: " . print_r($folders, true));

        foreach ($folders as $folder) {
            if ($folder === '.' || $folder === '..')
                continue;

            $classPath = $classDir . $folder;
            if (is_dir($classPath)) {
                $classInfo = $this->parseClassFolder($folder, $classPath);
                if ($classInfo) {
                    $classes[] = $classInfo;
                }
            }
        }

        // Sort classes by number
        usort($classes, function ($a, $b) {
            return $a['number'] - $b['number'];
        });

        return $classes;
    }

    /**
     * Get a specific class by ID
     */
    public function getClass($classId)
    {
        $classDir = $this->basePath . '/classes/class-' . $classId;

        if (!is_dir($classDir)) {
            error_log("Class directory not found: " . $classDir);
            return null;
        }

        return $this->parseClassFolder('class-' . $classId, $classDir);
    }

    /**
     * Parse class folder structure
     */
    private function parseClassFolder($folderName, $folderPath)
    {
        // Extract class number from folder name (e.g., "class-1" -> 1)
        preg_match('/class-(\d+)/', $folderName, $matches);
        if (!$matches)
            return null;

        $classNumber = $matches[1];

        $class = [
            'id' => $classNumber,
            'number' => (int) $classNumber,
            'folder' => $folderName,
            'path' => $folderPath,
            'title' => 'Class ' . $classNumber,
            'description' => '',
            'google_doc_url' => '',
            'estimated_time' => '',
            'prerequisites' => '',
            'difficulty' => 'Beginner',
            'learning_objectives' => []
        ];

        // Look for info.json file
        $infoFile = $folderPath . '/info.json';
        if (file_exists($infoFile)) {
            $infoContent = file_get_contents($infoFile);
            $info = json_decode($infoContent, true);
            if ($info) {
                $class['title'] = $info['title'] ?? $class['title'];
                $class['description'] = $info['description'] ?? '';
                $class['google_doc_url'] = $info['google_doc_url'] ?? '';
                $class['estimated_time'] = $info['estimated_time'] ?? '';
                $class['prerequisites'] = $info['prerequisites'] ?? '';
                $class['difficulty'] = $info['difficulty'] ?? 'Beginner';
                $class['learning_objectives'] = $info['learning_objectives'] ?? [];
            }
        }

        return $class;
    }

    /**
     * Get all challenges
     */
    public function getChallenges()
    {
        $challenges = [];
        $challengeDir = $this->basePath . '/challenges/';

        error_log("Looking for challenges in: " . $challengeDir);

        if (!is_dir($challengeDir)) {
            error_log("Challenge directory not found: " . $challengeDir);
            return $challenges;
        }

        // Scan difficulty folders
        $difficulties = ['easy', 'medium', 'hard'];

        foreach ($difficulties as $difficulty) {
            $difficultyPath = $challengeDir . $difficulty . '/';

            if (!is_dir($difficultyPath)) {
                error_log("Difficulty folder not found: " . $difficultyPath);
                continue;
            }

            $files = scandir($difficultyPath);

            foreach ($files as $file) {
                if ($file === '.' || $file === '..')
                    continue;

                $filePath = $difficultyPath . $file;
                $extension = pathinfo($file, PATHINFO_EXTENSION);

                if ($extension === 'json') {
                    $challengeInfo = $this->parseChallengeFile($filePath, $difficulty);
                    if ($challengeInfo) {
                        $challenges[] = $challengeInfo;
                    }
                }
            }
        }

        // Sort by ID
        usort($challenges, function ($a, $b) {
            return $a['id'] - $b['id'];
        });

        error_log("Found " . count($challenges) . " challenges");
        return $challenges;
    }

    /**
     * Get a specific challenge by ID
     */
    public function getChallenge($challengeId)
    {
        $challenges = $this->getChallenges();

        foreach ($challenges as $challenge) {
            if ($challenge['id'] == $challengeId) {
                return $challenge;
            }
        }

        return null;
    }

    /**
     * Parse challenge JSON file
     */
    private function parseChallengeFile($filePath, $difficulty)
    {
        if (!file_exists($filePath)) {
            error_log("Challenge file not found: " . $filePath);
            return null;
        }

        $content = file_get_contents($filePath);
        $data = json_decode($content, true);

        if (!$data) {
            error_log("Failed to parse JSON: " . $filePath);
            return null;
        }

        // Extract ID from filename (e.g., "challenge-1.json" -> 1)
        $filename = basename($filePath, '.json');
        preg_match('/challenge-(\d+)/', $filename, $matches);

        $id = $matches[1] ?? 0;

        return [
            'id' => (int) $id,
            'title' => $data['title'] ?? 'Challenge ' . $id,
            'description' => $data['description'] ?? '',
            'difficulty' => $difficulty,
            'points' => $data['points'] ?? 100,
            'category' => $data['category'] ?? 'General',
            'flag' => $data['flag'] ?? '',
            'hints' => $data['hints'] ?? [],
            'files' => $data['files'] ?? [],
            'content' => $data['content'] ?? ''
        ];
    }

    /**
     * Get file type for icon display
     */
    private function getFileType($filename)
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        $types = [
            'pdf' => 'pdf',
            'doc' => 'word',
            'docx' => 'word',
            'ppt' => 'powerpoint',
            'pptx' => 'powerpoint',
            'xls' => 'excel',
            'xlsx' => 'excel',
            'txt' => 'text',
            'zip' => 'archive',
            'rar' => 'archive',
            '7z' => 'archive',
            'jpg' => 'image',
            'jpeg' => 'image',
            'png' => 'image',
            'gif' => 'image',
            'mp4' => 'video',
            'avi' => 'video',
            'mov' => 'video',
            'md' => 'markdown'
        ];

        return $types[$extension] ?? 'file';
    }
}