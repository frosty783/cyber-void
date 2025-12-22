<?php
header('Content-Type: application/json');

$file = $_GET['file'] ?? '';
$type = $_GET['type'] ?? 'challenge';

if (empty($file)) {
    http_response_code(400);
    echo json_encode(['error' => 'No file specified']);
    exit;
}

// Sanitize file path
$file = basename($file);
$basePath = dirname(__DIR__);

if ($type === 'challenge') {
    $filePath = $basePath . '/challenges/' . $file;
} elseif ($type === 'class') {
    $filePath = $basePath . '/classes/' . $file;
} else {
    $filePath = $basePath . '/' . $file;
}

// Check if file exists and is within allowed directories
if (!file_exists($filePath) || strpos(realpath($filePath), $basePath) !== 0) {
    http_response_code(404);
    echo json_encode(['error' => 'File not found']);
    exit;
}

// Serve the file
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($filePath));
readfile($filePath);
exit;
?>