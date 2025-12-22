<?php
// Get progress from localStorage (simulated via JavaScript)
// In a real app, this would come from a database
?>

<h1 class="content-title">
    Dashboard
</h1>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Welcome to Cyber Void</h5>
                <p class="card-text">
                    Your interactive cybersecurity learning platform. Start with beginner classes, 
                    practice with challenges, and join live Discord sessions for hands-on learning.
                </p>
                <div class="mt-4">
                    <button class="btn btn-primary me-2" onclick="window.location.href='/classes'">
                        Start Learning
                    </button>
                    <button class="btn btn-outline-primary" onclick="window.location.href='/challenges'">
                        Try Challenges
                    </button>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Recent Challenges</h5>
                <div id="recentChallenges">
                    <!-- Will be populated by JavaScript -->
                    <div class="text-center py-4">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Your Progress</h5>
                <div class="text-center my-4">
                    <div class="position-relative d-inline-block">
                        <svg width="120" height="120" viewBox="0 0 120 120" id="progressCircle">
                            <circle cx="60" cy="60" r="54" fill="none" stroke="#e2e8f0" stroke-width="12"/>
                            <circle cx="60" cy="60" r="54" fill="none" stroke="#3182ce" stroke-width="12" 
                                    stroke-linecap="round" stroke-dasharray="339.292" stroke-dashoffset="339.292"
                                    transform="rotate(-90 60 60)" id="progressCircleFill"/>
                        </svg>
                        <div class="position-absolute top-50 start-50 translate-middle">
                            <span class="h3 fw-bold" id="progressPercent">0%</span>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <p class="text-muted" id="progressText">Loading progress...</p>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Upcoming Sessions</h5>
                <div class="mt-3" id="upcomingSessions">
                    <!-- Will be populated by JavaScript -->
                    <div class="text-center py-3">
                        <div class="spinner-border spinner-border-sm text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Load and display user progress
function loadUserProgress() {
    const progress = JSON.parse(localStorage.getItem('cybervoid_progress') || '{}');
    const challenges = progress.challenges || {};
    const classes = progress.classes || {};
    
    // Calculate progress percentage
    const totalChallenges = <?php echo count($fileLoader->getChallenges()); ?>;
    const totalClasses = <?php echo count($fileLoader->getClasses()); ?>;
    const completedChallenges = Object.keys(challenges).length;
    const completedClasses = Object.keys(classes).length;
    
    const totalItems = totalChallenges + totalClasses;
    const completedItems = completedChallenges + completedClasses;
    const percentage = totalItems > 0 ? Math.round((completedItems / totalItems) * 100) : 0;
    
    // Update progress circle
    const circle = document.getElementById('progressCircleFill');
    const circumference = 339.292;
    const offset = circumference - (percentage / 100) * circumference;
    circle.style.strokeDashoffset = offset;
    
    // Update text
    document.getElementById('progressPercent').textContent = percentage + '%';
    document.getElementById('progressText').innerHTML = `
        Completed <strong>${completedChallenges}</strong> of <strong>${totalChallenges}</strong> challenges<br>
        Finished <strong>${completedClasses}</strong> of <strong>${totalClasses}</strong> classes
    `;
    
    // Load recent challenges
    loadRecentChallenges(challenges);
    
    // Load upcoming sessions
    loadUpcomingSessions();
}

// Load recent challenges
function loadRecentChallenges(userChallenges) {
    const container = document.getElementById('recentChallenges');
    
    <?php
    $challenges = $fileLoader->getChallenges();
    $recentChallenges = array_slice($challenges, 0, 5); // Get first 5
    ?>
    
    const challenges = <?php echo json_encode($recentChallenges); ?>;
    
    let html = '<div class="list-group list-group-flush">';
    
    challenges.forEach(challenge => {
        const isCompleted = userChallenges[challenge.id];
        let badgeClass = 'badge-easy';
        if (challenge.difficulty === 'medium') badgeClass = 'badge-medium';
        if (challenge.difficulty === 'hard') badgeClass = 'badge-hard';
        
        html += `
            <button class="list-group-item list-group-item-action dashboard-challenge-item" 
                    onclick="window.location.href='/challenges/${challenge.id}'">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <span class="fw-medium">${challenge.title}</span>
                        ${isCompleted ? '<i class="fas fa-check text-success ms-2"></i>' : ''}
                        <small class="text-muted ms-2 d-block d-md-inline">${challenge.description}</small>
                    </div>
                    <div>
                        <span class="badge ${badgeClass}">${challenge.difficulty}</span>
                        <span class="badge bg-primary ms-1">${challenge.points} pts</span>
                    </div>
                </div>
            </button>
        `;
    });
    
    html += '</div>';
    container.innerHTML = html;
}

// Load upcoming sessions
function loadUpcomingSessions() {
    const container = document.getElementById('upcomingSessions');
    
    // Sample session data - in real app, this would come from an API
    const sessions = [
        {
            date: '15 MAR',
            title: 'Class 3: Cryptography',
            time: '2:00 PM - 3:30 PM',
            type: 'Discord Live'
        },
        {
            date: '18 MAR',
            title: 'Challenge Walkthrough',
            time: '6:00 PM - 7:00 PM',
            type: 'Q&A Session'
        },
        {
            date: '22 MAR',
            title: 'Class 4: Web Security',
            time: '4:00 PM - 5:30 PM',
            type: 'Hands-on Lab'
        }
    ];
    
    let html = '';
    
    sessions.forEach(session => {
        html += `
            <div class="d-flex mb-3">
                <div class="flex-shrink-0">
                    <div class="bg-info text-white rounded p-2 text-center" style="width: 50px;">
                        <div class="fw-bold">${session.date.split(' ')[0]}</div>
                        <div class="small">${session.date.split(' ')[1]}</div>
                    </div>
                </div>
                <div class="flex-grow-1 ms-3">
                    <h6 class="mb-0">${session.title}</h6>
                    <small class="text-muted">${session.time}</small>
                    <div class="mt-1">
                        <span class="badge bg-light text-dark">${session.type}</span>
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    loadUserProgress();
});
</script>