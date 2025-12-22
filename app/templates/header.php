<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cyber Void - Cybersecurity Learning Platform</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-blue: #1a365d;
            --secondary-blue: #2d3748;
            --accent-blue: #3182ce;
            --light-blue: #ebf8ff;
            --dark-gray: #1a202c;
            --medium-gray: #4a5568;
            --light-gray: #e2e8f0;
            --success-green: #38a169;
            --warning-orange: #ed8936;
            --danger-red: #e53e3e;
            --cyber-green: #48bb78;
            --text-light: #f7fafc;
            --text-dark: #2d3748;
        }
        
        body {
            background-color: #f8f9fa;
            color: var(--text-dark);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        
        /* Top Navigation - Simple with only brand and Tips & Tricks */
        .navbar-cyber {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            padding: 0.8rem 0;
            border-bottom: 3px solid var(--accent-blue);
            min-height: 70px;
        }
        
        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 0 1rem;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-blue) !important;
            margin-right: auto; /* Push to far left */
        }
        
        .brand-cyber {
            color: var(--accent-blue);
        }
        
        /* Tips & Tricks button on far right */
        .btn-tips {
            background-color: var(--accent-blue);
            color: white;
            border: none;
            padding: 0.5rem 1.2rem;
            font-size: 0.95rem;
            border-radius: 6px;
            transition: all 0.3s;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
        }
        
        .btn-tips:hover {
            background-color: #2c5282;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(49, 130, 206, 0.2);
        }
        
        /* Main Container - Sidebar moved to left edge */
        .main-container {
            min-height: calc(100vh - 70px);
            padding: 0;
            display: flex;
        }
        
        /* Sidebar - Full height on left edge */
        .sidebar {
            background-color: white;
            height: calc(100vh - 70px);
            width: 280px;
            overflow-y: auto;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.05);
            flex-shrink: 0;
        }
        
        .sidebar-content {
            padding: 1.5rem;
        }
        
        .sidebar-title {
            color: var(--primary-blue);
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 1.2rem;
            padding-bottom: 0.8rem;
            border-bottom: 2px solid var(--light-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        /* Collapsible sections */
        .collapse-btn {
            background: none;
            border: none;
            color: var(--medium-gray);
            font-size: 0.9rem;
            cursor: pointer;
            padding: 0;
            transition: color 0.2s;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            font-weight: 500;
        }
        
        .collapse-btn:hover {
            color: var(--accent-blue);
        }
        
        .collapse-icon {
            transition: transform 0.3s;
            font-size: 0.8rem;
        }
        
        .collapse-icon.collapsed {
            transform: rotate(-90deg);
        }
        
        /* Nested items in collapsible sections - Not looking like links */
        .nested-list {
            list-style: none;
            padding-left: 0.5rem;
            margin: 0.5rem 0 1.5rem 0;
        }
        
        .nested-list li {
            margin-bottom: 0.4rem;
        }
        
        /* Class items - Plain text look */
        .class-item {
            display: flex;
            align-items: center;
            padding: 0.5rem 0.8rem;
            color: var(--medium-gray);
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 0.9rem;
        }
        
        .class-item:hover {
            background-color: var(--light-blue);
            color: var(--accent-blue);
        }
        
        .class-item.active {
            background-color: var(--light-blue);
            color: var(--accent-blue);
            border-left: 3px solid var(--accent-blue);
        }
        
        /* Challenge items with badges - Plain text look */
        .challenge-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0.8rem;
            color: var(--medium-gray);
            text-decoration: none;
            border-radius: 4px;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 0.9rem;
        }
        
        .challenge-item:hover {
            background-color: var(--light-blue);
            color: var(--accent-blue);
        }
        
        .challenge-item.active {
            background-color: var(--light-blue);
            color: var(--accent-blue);
            border-left: 3px solid var(--accent-blue);
        }
        
        /* Challenge Difficulty Badges */
        .badge-easy {
            background-color: var(--success-green);
            color: white;
            font-size: 0.7rem;
            padding: 0.15rem 0.5rem;
            border-radius: 10px;
            font-weight: 500;
        }
        
        .badge-medium {
            background-color: var(--warning-orange);
            color: white;
            font-size: 0.7rem;
            padding: 0.15rem 0.5rem;
            border-radius: 10px;
            font-weight: 500;
        }
        
        .badge-hard {
            background-color: var(--danger-red);
            color: white;
            font-size: 0.7rem;
            padding: 0.15rem 0.5rem;
            border-radius: 10px;
            font-weight: 500;
        }
        
        /* Main Content Area */
        .main-content {
            flex-grow: 1;
            padding: 2rem;
            min-height: calc(100vh - 70px);
            overflow-y: auto;
        }
        
        .content-card {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            min-height: 500px;
        }
        
        .content-title {
            color: var(--primary-blue);
            font-weight: 600;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--light-gray);
        }
        
        /* Footer */
        .footer {
            background-color: var(--primary-blue);
            color: white;
            padding: 1.5rem 0;
            margin-top: 3rem;
        }
        
        .footer a {
            color: #a0aec0;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .footer a:hover {
            color: white;
        }
        
        /* Dashboard Challenge List Styles */
        .dashboard-challenge-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 1rem;
            border-left: 4px solid var(--light-gray);
            transition: all 0.3s;
            text-decoration: none;
            color: var(--text-dark);
        }
        
        .dashboard-challenge-item:hover {
            border-left-color: var(--accent-blue);
            background-color: var(--light-blue);
        }
        
        /* Responsive adjustments */
        @media (max-width: 992px) {
            .sidebar {
                width: 250px;
            }
        }
        
        @media (max-width: 768px) {
            .main-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                max-height: 300px;
            }
            
            .main-content {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Top Navigation - Only Brand and Tips & Tricks -->
    <nav class="navbar-cyber">
        <div class="navbar-container">
            <!-- Cyber Void on far left -->
            <a class="navbar-brand" href="/">
                <span class="brand-cyber">Cyber</span>Void
            </a>
            
            <!-- Tips & Tricks button on far right -->
            <a href="/tips" class="btn-tips">
                <i class="fas fa-lightbulb me-1"></i> Tips & Tricks
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Sidebar - Fixed on left edge -->
        <!-- Sidebar - Fixed on left edge -->
        <div class="sidebar">
            <div class="sidebar-content">
                <!-- Quick Navigation Title -->
                <div class="sidebar-title">
                    <span>Quick Navigation</span>
                </div>
                
                <!-- Collapsible Classes Section -->
                <div class="mb-4">
                    <button class="collapse-btn" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#classesCollapse"
                            aria-expanded="true">
                        <span>Classes</span>
                        <i class="fas fa-chevron-down collapse-icon"></i>
                    </button>
                    
                    <div class="collapse show" id="classesCollapse">
                        <ul class="nested-list">
                            <?php
                            // Load classes directly from PHP
                            $fileLoader = new FileLoader();
                            $classes = $fileLoader->getClasses();
                            
                            if (!empty($classes)):
                                foreach ($classes as $class):
                            ?>
                            <li>
                                <button class="class-item" onclick="window.location.href='/classes/<?php echo $class['id']; ?>'">
                                    <?php echo htmlspecialchars($class['title']); ?>
                                </button>
                            </li>
                            <?php
                                endforeach;
                            else:
                            ?>
                            <li>
                                <div class="text-muted small p-2">
                                    No classes available yet.
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                
                <!-- Collapsible Challenges Section -->
                <div class="mb-4">
                    <button class="collapse-btn" 
                            data-bs-toggle="collapse" 
                            data-bs-target="#challengesCollapse"
                            aria-expanded="true">
                        <span>Challenges</span>
                        <i class="fas fa-chevron-down collapse-icon"></i>
                    </button>
                    
                    <div class="collapse show" id="challengesCollapse">
                        <ul class="nested-list">
                            <?php
                            // Load challenges directly from PHP
                            $challenges = $fileLoader->getChallenges();
                            
                            if (!empty($challenges)):
                                // Sort by difficulty
                                usort($challenges, function($a, $b) {
                                    $difficultyOrder = ['easy' => 1, 'medium' => 2, 'hard' => 3];
                                    return $difficultyOrder[$a['difficulty']] - $difficultyOrder[$b['difficulty']];
                                });
                                
                                foreach ($challenges as $challenge):
                                    // Determine badge class
                                    $badgeClass = 'badge-easy';
                                    if ($challenge['difficulty'] === 'medium') $badgeClass = 'badge-medium';
                                    if ($challenge['difficulty'] === 'hard') $badgeClass = 'badge-hard';
                            ?>
                            <li>
                                <button class="challenge-item" onclick="window.location.href='/challenges/<?php echo $challenge['id']; ?>'">
                                    <span><?php echo htmlspecialchars($challenge['title']); ?></span>
                                    <span class="badge <?php echo $badgeClass; ?>"><?php echo $challenge['difficulty']; ?></span>
                                </button>
                            </li>
                            <?php
                                endforeach;
                            else:
                            ?>
                            <li>
                                <div class="text-muted small p-2">
                                    No challenges available yet.
                                </div>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                
                <!-- Discord Section -->
                <div class="mt-4 pt-3 border-top">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fab fa-discord me-2" style="color: #5865f2;"></i>
                        <span class="fw-medium">Live on Discord</span>
                    </div>
                    <p class="small text-muted mb-2">Join our Discord server for live classes and community support.</p>
                    <a href="https://discord.gg/cybervoid" 
                       target="_blank" 
                       class="btn btn-sm w-100" 
                       style="background-color: #5865f2; color: white; text-decoration: none;">
                        Join Discord
                    </a>
                </div>
                
                <!-- Debug link for students (hidden in production) -->
                <div class="mt-3 pt-3 border-top">
                    <a href="/debug" class="small text-muted" style="text-decoration: none;">
                        <i class="fas fa-bug me-1"></i> Debug Info
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Main Content Area -->
        <div class="main-content">
            <div class="content-card" id="mainContent">
                <!-- Content will be loaded here -->