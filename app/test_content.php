<?php
require_once 'FileLoader.php';

$loader = new FileLoader();

echo "<h2>Testing Content Loader</h2>";

$classes = $loader->getClasses();
echo "<h3>Classes Found: " . count($classes) . "</h3>";
foreach ($classes as $class) {
    echo "Class {$class['id']}: {$class['title']}<br>";
}

$challenges = $loader->getChallenges();
echo "<h3>Challenges Found: " . count($challenges) . "</h3>";
foreach ($challenges as $challenge) {
    echo "Challenge {$challenge['id']}: {$challenge['title']} ({$challenge['difficulty']})<br>";
}
?>