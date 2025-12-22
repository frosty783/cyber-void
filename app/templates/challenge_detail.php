<?php
$challengeId = $params[0] ?? null;
$challenge = $fileLoader->getChallenge($challengeId);

if (!$challenge) {
    echo '<div class="alert alert-danger">Challenge not found.</div>';
    return;
}

// Determine badge class
$badgeClass = 'badge-easy';
if ($challenge['difficulty'] === 'medium') $badgeClass = 'badge-medium';
if ($challenge['difficulty'] === 'hard') $badgeClass = 'badge-hard';
?>

<h1 class="content-title">
    <?php echo htmlspecialchars($challenge['title']); ?>
    <span class="badge <?php echo $badgeClass; ?> ms-2"><?php echo ucfirst($challenge['difficulty']); ?></span>
    <span class="badge bg-primary ms-2"><?php echo $challenge['points']; ?> points</span>
</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Challenge Description</h5>
                <div class="challenge-content">
                    <?php 
                    // Simple markdown-like rendering
                    $content = htmlspecialchars($challenge['content']);
                    $content = preg_replace('/# (.*)/', '<h3>$1</h3>', $content);
                    $content = preg_replace('/## (.*)/', '<h4>$1</h4>', $content);
                    $content = str_replace("\n", '<br>', $content);
                    echo $content;
                    ?>
                </div>
                
                <?php if (!empty($challenge['files'])): ?>
                <div class="mt-4">
                    <h6>Challenge Files</h6>
                    <div class="list-group">
                        <?php foreach ($challenge['files'] as $file): ?>
                        <a href="/<?php echo $file['path']; ?>" 
                           target="_blank" 
                           class="list-group-item list-group-item-action">
                            <i class="fas fa-download me-2"></i>
                            <?php echo htmlspecialchars($file['name']); ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Submit Flag</h5>
                <div class="mb-3">
                    <label for="flagInput" class="form-label">Enter the flag:</label>
                    <input type="text" class="form-control" id="flagInput" placeholder="BSY{...}">
                </div>
                <button class="btn btn-primary w-100" onclick="submitFlag()">
                    Submit Flag
                </button>
                <div id="flagResult" class="mt-2" style="display: none;"></div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Hints</h5>
                <?php if (!empty($challenge['hints'])): ?>
                    <div class="accordion" id="hintsAccordion">
                        <?php foreach ($challenge['hints'] as $index => $hint): ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#hint<?php echo $index; ?>">
                                    Hint <?php echo $index + 1; ?>
                                </button>
                            </h2>
                            <div id="hint<?php echo $index; ?>" class="accordion-collapse collapse" 
                                 data-bs-parent="#hintsAccordion">
                                <div class="accordion-body">
                                    <?php echo htmlspecialchars($hint); ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No hints available for this challenge.</p>
                <?php endif; ?>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Challenge Info</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <strong>Difficulty:</strong>
                        <span class="badge <?php echo $badgeClass; ?> ms-2"><?php echo ucfirst($challenge['difficulty']); ?></span>
                    </li>
                    <li class="mb-2">
                        <strong>Points:</strong> <?php echo $challenge['points']; ?>
                    </li>
                    <li class="mb-2">
                        <strong>Category:</strong> <?php echo htmlspecialchars($challenge['category']); ?>
                    </li>
                    <li>
                        <strong>Flag Format:</strong> BSY{...}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
function submitFlag() {
    const flagInput = document.getElementById('flagInput');
    const flagResult = document.getElementById('flagResult');
    const userFlag = flagInput.value.trim();
    const challengeId = <?php echo $challenge['id']; ?>;
    const points = <?php echo $challenge['points']; ?>;
    
    // Simple client-side check (in real app, this would be server-side)
    if (userFlag === '<?php echo $challenge['flag']; ?>') {
        // Save progress to localStorage (simulated)
        saveProgress(challengeId, points);
        
        flagResult.innerHTML = `
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                Correct flag! You earned ${points} points.
            </div>
        `;
        flagResult.style.display = 'block';
        
        // Clear input
        flagInput.value = '';
        
        // Update progress display
        updateProgressDisplay();
    } else if (userFlag.startsWith('BSY{') && userFlag.endsWith('}')) {
        flagResult.innerHTML = `
            <div class="alert alert-danger">
                <i class="fas fa-times-circle me-2"></i>
                Incorrect flag. Try again!
            </div>
        `;
        flagResult.style.display = 'block';
    } else {
        flagResult.innerHTML = `
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle me-2"></i>
                Invalid flag format. Flag should be in BSY{...} format.
            </div>
        `;
        flagResult.style.display = 'block';
    }
}

function saveProgress(challengeId, points) {
    // Get existing progress
    let progress = JSON.parse(localStorage.getItem('cybervoid_progress') || '{}');
    
    if (!progress.challenges) {
        progress.challenges = {};
    }
    
    // Mark challenge as completed
    progress.challenges[challengeId] = {
        completed: true,
        points: points,
        completed_at: new Date().toISOString()
    };
    
    // Save back to localStorage
    localStorage.setItem('cybervoid_progress', JSON.stringify(progress));
}

function updateProgressDisplay() {
    // Update sidebar progress if available
    const progressElement = document.getElementById('userProgress');
    if (progressElement) {
        const progress = JSON.parse(localStorage.getItem('cybervoid_progress') || '{}');
        const completedChallenges = Object.keys(progress.challenges || {}).length;
        progressElement.textContent = `${completedChallenges} challenges completed`;
    }
}

// Initialize progress display
document.addEventListener('DOMContentLoaded', function() {
    updateProgressDisplay();
});
</script>