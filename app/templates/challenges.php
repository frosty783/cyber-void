<?php
$challenges = $fileLoader->getChallenges();

// Group challenges by difficulty
$challengesByDifficulty = [
    'easy' => [],
    'medium' => [],
    'hard' => []
];

foreach ($challenges as $challenge) {
    $challengesByDifficulty[$challenge['difficulty']][] = $challenge;
}
?>

<h1 class="content-title">
    All Challenges
</h1>

<div class="row">
    <!-- Easy Challenges -->
    <div class="col-12 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">
                    <i class="fas fa-star me-2"></i> Easy Challenges
                    <span class="badge bg-light text-dark ms-2"><?php echo count($challengesByDifficulty['easy']); ?></span>
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($challengesByDifficulty['easy'])): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($challengesByDifficulty['easy'] as $challenge): ?>
                        <a href="/challenges/<?php echo $challenge['id']; ?>" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center challenge-item">
                            <div>
                                <span class="fw-medium"><?php echo htmlspecialchars($challenge['title']); ?></span>
                                <small class="text-muted ms-2"><?php echo htmlspecialchars($challenge['description']); ?></small>
                            </div>
                            <div>
                                <span class="badge badge-easy me-2">Easy</span>
                                <span class="badge bg-primary"><?php echo $challenge['points']; ?> pts</span>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center py-3">No easy challenges available yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Medium Challenges -->
    <div class="col-12 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">
                    <i class="fas fa-star-half-alt me-2"></i> Medium Challenges
                    <span class="badge bg-light text-dark ms-2"><?php echo count($challengesByDifficulty['medium']); ?></span>
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($challengesByDifficulty['medium'])): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($challengesByDifficulty['medium'] as $challenge): ?>
                        <a href="/challenges/<?php echo $challenge['id']; ?>" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center challenge-item">
                            <div>
                                <span class="fw-medium"><?php echo htmlspecialchars($challenge['title']); ?></span>
                                <small class="text-muted ms-2"><?php echo htmlspecialchars($challenge['description']); ?></small>
                            </div>
                            <div>
                                <span class="badge badge-medium me-2">Medium</span>
                                <span class="badge bg-primary"><?php echo $challenge['points']; ?> pts</span>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center py-3">No medium challenges available yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <!-- Hard Challenges -->
    <div class="col-12 mb-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0">
                    <i class="fas fa-star me-2"></i> Hard Challenges
                    <span class="badge bg-light text-dark ms-2"><?php echo count($challengesByDifficulty['hard']); ?></span>
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($challengesByDifficulty['hard'])): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($challengesByDifficulty['hard'] as $challenge): ?>
                        <a href="/challenges/<?php echo $challenge['id']; ?>" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center challenge-item">
                            <div>
                                <span class="fw-medium"><?php echo htmlspecialchars($challenge['title']); ?></span>
                                <small class="text-muted ms-2"><?php echo htmlspecialchars($challenge['description']); ?></small>
                            </div>
                            <div>
                                <span class="badge badge-hard me-2">Hard</span>
                                <span class="badge bg-primary"><?php echo $challenge['points']; ?> pts</span>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted text-center py-3">No hard challenges available yet.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>