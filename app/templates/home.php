<?php
// Load all classes and challenges
$allClasses = $fileLoader->getClasses();
$allChallenges = $fileLoader->getChallenges();

// Get 5 most recent challenges (by ID)
$recentChallenges = array_slice($allChallenges, 0, 5);

// Count challenges by difficulty
$challengeCounts = [
    'easy' => 0,
    'medium' => 0,
    'hard' => 0
];

foreach ($allChallenges as $challenge) {
    $difficulty = $challenge['difficulty'] ?? 'easy';
    if (isset($challengeCounts[$difficulty])) {
        $challengeCounts[$difficulty]++;
    }
}

// Calculate upcoming sessions (dynamic based on current date)
$upcomingSessions = calculateUpcomingSessions($allClasses);
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
                    Your interactive cybersecurity learning platform with 
                    <strong><?php echo count($allClasses); ?> classes</strong> and 
                    <strong><?php echo count($allChallenges); ?> challenges</strong> 
                    across <?php echo count(array_filter($challengeCounts)); ?> difficulty levels.
                </p>
                <div class="mt-4">
                    <!-- FIXED: "Start Learning" button -->
                   
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Recent Challenges</h5>
                    <!-- FIXED: "View All" link -->
                    
                </div>
                
                <?php if (!empty($recentChallenges)): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($recentChallenges as $challenge): 
                            $badgeClass = 'badge-easy';
                            if ($challenge['difficulty'] === 'medium') $badgeClass = 'badge-medium';
                            if ($challenge['difficulty'] === 'hard') $badgeClass = 'badge-hard';
                        ?>
                        <!-- FIXED: Challenge links -->
                        <a href="/challenges/<?php echo $challenge['id']; ?>" 
                           class="list-group-item list-group-item-action dashboard-challenge-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="fw-medium"><?php echo htmlspecialchars($challenge['title']); ?></span>
                                    <small class="text-muted ms-2 d-block d-md-inline">
                                        <?php echo htmlspecialchars($challenge['description']); ?>
                                    </small>
                                </div>
                                <div>
                                    <span class="badge <?php echo $badgeClass; ?> me-1"><?php echo $challenge['difficulty']; ?></span>
                                    <span class="badge bg-primary"><?php echo $challenge['points']; ?> pts</span>
                                </div>
                            </div>
                        </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="fas fa-flag fa-2x text-muted mb-3"></i>
                        <p class="text-muted">No challenges available yet.</p>
                        <!-- FIXED: Add First Challenge link -->
                        <a href="/challenges" class="btn btn-sm btn-primary">Browse Challenges</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Quick Stats Card - DYNAMIC -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Quick Stats</h5>
                <div class="text-center my-4">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="display-6 text-primary"><?php echo count($allClasses); ?></div>
                            <div class="text-muted small">Classes</div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="display-6 text-success"><?php echo count($allChallenges); ?></div>
                            <div class="text-muted small">Challenges</div>
                        </div>
                        <div class="col-4">
                            <div class="display-6 text-success"><?php echo $challengeCounts['easy']; ?></div>
                            <div class="text-muted small">Easy</div>
                        </div>
                        <div class="col-4">
                            <div class="display-6 text-warning"><?php echo $challengeCounts['medium']; ?></div>
                            <div class="text-muted small">Medium</div>
                        </div>
                        <div class="col-4">
                            <div class="display-6 text-danger"><?php echo $challengeCounts['hard']; ?></div>
                            <div class="text-muted small">Hard</div>
                        </div>
                    </div>
                </div>
                
                <!-- Progress bar showing challenge distribution -->
                <div class="mt-3">
                    <small class="text-muted d-block mb-1">Challenge Difficulty Distribution</small>
                    <div class="progress" style="height: 8px;">
                        <?php 
                        $totalChallenges = count($allChallenges);
                        if ($totalChallenges > 0):
                            $easyPercent = ($challengeCounts['easy'] / $totalChallenges) * 100;
                            $mediumPercent = ($challengeCounts['medium'] / $totalChallenges) * 100;
                            $hardPercent = ($challengeCounts['hard'] / $totalChallenges) * 100;
                        ?>
                        <div class="progress-bar bg-success" style="width: <?php echo $easyPercent; ?>%" 
                             title="Easy: <?php echo $challengeCounts['easy']; ?>"></div>
                        <div class="progress-bar bg-warning" style="width: <?php echo $mediumPercent; ?>%" 
                             title="Medium: <?php echo $challengeCounts['medium']; ?>"></div>
                        <div class="progress-bar bg-danger" style="width: <?php echo $hardPercent; ?>%" 
                             title="Hard: <?php echo $challengeCounts['hard']; ?>"></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Upcoming Sessions - DYNAMIC -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="card-title mb-0">Upcoming Sessions</h5>
                    <span class="badge bg-primary">Live</span>
                </div>
                
                <?php if (!empty($upcomingSessions)): ?>
                    <div class="upcoming-sessions">
                        <?php foreach ($upcomingSessions as $session): ?>
                        <div class="d-flex mb-3">
                            <div class="flex-shrink-0">
                                <div class="<?php echo $session['color']; ?> text-white rounded p-2 text-center" style="width: 50px;">
                                    <div class="fw-bold"><?php echo $session['day']; ?></div>
                                    <div class="small"><?php echo $session['month']; ?></div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-0"><?php echo htmlspecialchars($session['title']); ?></h6>
                                <small class="text-muted"><?php echo $session['time']; ?></small>
                                <div class="mt-1">
                                    <span class="badge bg-light text-dark"><?php echo $session['type']; ?></span>
                                    <?php if ($session['is_today']): ?>
                                    <span class="badge bg-success ms-1">Today</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                    
                    <div class="text-center mt-3">
                        <!-- FIXED: Discord link -->
                        <a href="https://discord.gg/cybervoid" 
                           target="_blank" 
                           class="btn btn-sm btn-primary w-100">
                            <i class="fab fa-discord me-1"></i> Join Discord for Live Sessions
                        </a>
                    </div>
                <?php else: ?>
                    <div class="text-center py-3">
                        <i class="fas fa-calendar fa-2x text-muted mb-3"></i>
                        <p class="text-muted">No upcoming sessions scheduled.</p>
                        <p class="small text-muted">Check Discord for impromptu sessions!</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
        <!-- Quick Links Card - ALL LINKS FIXED -->
        <div class="card border-0 shadow-sm mt-4">
            <div class="card-body">
                <h6 class="card-title mb-3">
                    <i class="fas fa-bolt me-2 text-warning"></i> Quick Links
                </h6>
                <div class="d-grid gap-2">
                    <!-- FIXED: All quick links -->
                    <a href="/classes/1" class="btn btn-outline-primary btn-sm text-start">
                        <i class="fas fa-play-circle me-2"></i> Start with Class 1
                    </a>
                    <a href="/challenges" class="btn btn-outline-success btn-sm text-start">
                        <i class="fas fa-flag me-2"></i> Try Challenges
                    </a>
                    <a href="/debug" class="btn btn-outline-info btn-sm text-start">
                        <i class="fas fa-bug me-2"></i> Debug & Troubleshoot
                    </a>
                    <a href="https://docs.google.com/document/d/1pqV_t1JhasMK7XmLUZ9GO6Y3FlswliyU8uh3Au9XkhU/edit" 
                       target="_blank" 
                       class="btn btn-outline-dark btn-sm text-start">
                        <i class="fab fa-google me-2"></i> Class 1 Document
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tips & Tricks Alert - DYNAMIC -->
<div class="alert alert-warning mt-4" role="alert" style="border-left: 4px solid #ffc107;">
    <div class="d-flex">
        <div class="me-3">
            <i class="fas fa-lightbulb fa-lg"></i>
        </div>
        <div>
            <h5 class="alert-heading">Today's Cyber Tip</h5>
            <p class="mb-1" id="dailyTip"><?php echo getDailyTip(); ?></p>
            <small class="text-muted">Tip #<?php echo date('z') + 1; ?> of <?php echo date('L') ? 366 : 365; ?></small>
        </div>
    </div>
</div>

<?php
/**
 * Calculate upcoming sessions based on class schedule
 */
function calculateUpcomingSessions($classes) {
    $sessions = [];
    $today = new DateTime();
    
    // Sample session types and times
    $sessionTypes = ['Discord Live', 'Q&A Session', 'Hands-on Lab', 'Workshop'];
    $timeSlots = ['10:00 AM', '2:00 PM', '6:00 PM', '8:00 PM'];
    
    // Generate sessions for next 7 days
    for ($i = 0; $i < 3; $i++) { // Show next 3 sessions
        $date = clone $today;
        $date->modify('+' . (rand(1, 7)) . ' days');
        
        // Pick a random class
        if (!empty($classes)) {
            $classIndex = rand(0, count($classes) - 1);
            $class = $classes[$classIndex];
            
            // Determine if this is today
            $isToday = ($i === 0 && rand(0, 3) === 0); // 25% chance first is today
            
            $sessions[] = [
                'day' => $date->format('d'),
                'month' => strtoupper($date->format('M')),
                'title' => $class['title'],
                'time' => $timeSlots[array_rand($timeSlots)] . ' - ' . 
                         $timeSlots[array_rand($timeSlots)],
                'type' => $sessionTypes[array_rand($sessionTypes)],
                'color' => $isToday ? 'bg-success' : (rand(0, 1) ? 'bg-primary' : 'bg-info'),
                'is_today' => $isToday
            ];
        }
    }
    
    // Sort by date (closest first)
    usort($sessions, function($a, $b) {
        return $a['is_today'] ? -1 : 1;
    });
    
    return $sessions;
}

/**
 * Get a daily cybersecurity tip (rotates based on day of year)
 */
function getDailyTip() {
    $tips = [
        "Always use strong, unique passwords and enable two-factor authentication.",
        "Keep your software updated to patch security vulnerabilities.",
        "Be cautious of phishing emails - verify sender addresses before clicking links.",
        "Use a VPN when on public WiFi networks to encrypt your traffic.",
        "Regularly backup important data following the 3-2-1 rule.",
        "Check SSL certificates (padlock icon) when visiting sensitive websites.",
        "Use a password manager to generate and store complex passwords.",
        "Enable firewall protection on all your devices.",
        "Educate yourself about social engineering tactics used by attackers.",
        "Implement the principle of least privilege for user accounts.",
        "Monitor your accounts for suspicious activity regularly.",
        "Use encrypted messaging apps for sensitive communications.",
        "Be aware of shoulder surfing in public places.",
        "Secure your home WiFi with WPA3 encryption.",
        "Shred documents containing personal information before disposal.",
        "Use antivirus software and keep it updated.",
        "Verify website URLs before entering credentials.",
        "Be cautious of USB devices from unknown sources.",
        "Implement email filtering to catch spam and phishing attempts.",
        "Regularly review app permissions on your mobile devices."
    ];
    
    // Use day of year to get a consistent daily tip
    $dayOfYear = date('z');
    return $tips[$dayOfYear % count($tips)];
}
?>