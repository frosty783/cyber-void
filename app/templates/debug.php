<?php
// Debug template to check what's loading
$classes = $fileLoader->getClasses();
$challenges = $fileLoader->getChallenges();

// Create a getter method in FileLoader or use reflection
// Let's add a public method to FileLoader first
?>

<h1 class="content-title">Debug Information</h1>

<div class="row">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Classes Loaded (<?php echo count($classes); ?>)</h5>
                <?php if (!empty($classes)): ?>
                    <ul>
                    <?php foreach ($classes as $class): ?>
                        <li>Class <?php echo $class['id']; ?>: <?php echo htmlspecialchars($class['title']); ?></li>
                    <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-danger">No classes found!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Challenges Loaded (<?php echo count($challenges); ?>)</h5>
                <?php if (!empty($challenges)): ?>
                    <ul>
                    <?php foreach ($challenges as $challenge): ?>
                        <li>Challenge <?php echo $challenge['id']; ?>: <?php echo htmlspecialchars($challenge['title']); ?> (<?php echo $challenge['difficulty']; ?>)</li>
                    <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-danger">No challenges found!</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h5 class="card-title">Server Information</h5>
        <ul>
            <li>Document Root: <?php echo htmlspecialchars($_SERVER['DOCUMENT_ROOT']); ?></li>
            <li>Current Directory: <?php echo htmlspecialchars(__DIR__); ?></li>
            <li>App Path: <?php echo htmlspecialchars(dirname(__DIR__)); ?></li>
            <li>PHP Version: <?php echo phpversion(); ?></li>
            <li>Loaded Classes: <?php echo count($classes); ?></li>
            <li>Loaded Challenges: <?php echo count($challenges); ?></li>
        </ul>
        
        <div class="mt-3">
            <h6>Directory Structure Check:</h6>
            <ul>
                <li>Classes directory exists: <?php echo is_dir(dirname(__DIR__) . '/classes/') ? '✅ Yes' : '❌ No'; ?></li>
                <li>Challenges directory exists: <?php echo is_dir(dirname(__DIR__) . '/challenges/') ? '✅ Yes' : '❌ No'; ?></li>
                <li>Easy challenges directory exists: <?php echo is_dir(dirname(__DIR__) . '/challenges/easy/') ? '✅ Yes' : '❌ No'; ?></li>
                <li>Medium challenges directory exists: <?php echo is_dir(dirname(__DIR__) . '/challenges/medium/') ? '✅ Yes' : '❌ No'; ?></li>
                <li>Hard challenges directory exists: <?php echo is_dir(dirname(__DIR__) . '/challenges/hard/') ? '✅ Yes' : '❌ No'; ?></li>
            </ul>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-body">
        <h5 class="card-title">For Students (Troubleshooting Guide)</h5>
        <p>If you're seeing issues with content not loading:</p>
        <ol>
            <li>Make sure Docker is running: <code>docker-compose up --build</code></li>
            <li>Check if content folders exist in the correct location</li>
            <li>Verify JSON files are valid (no syntax errors)</li>
            <li>Clear browser cache or try incognito mode</li>
            <li>Check Docker logs: <code>docker-compose logs -f</code></li>
        </ol>
        <p class="text-muted small mt-3">
            <i class="fas fa-info-circle me-1"></i>
            This debug page can be disabled in production by removing the '/debug' route from index.php
        </p>
    </div>
</div>