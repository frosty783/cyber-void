<?php
// Tips & Tricks data - can be loaded from a file in the future
$tips = [
    [
        'title' => 'Strong Password Creation',
        'content' => 'Use a combination of uppercase, lowercase, numbers, and special characters. Avoid using personal information.',
        'category' => 'General Security',
        'icon' => 'fas fa-key'
    ],
    [
        'title' => 'Two-Factor Authentication',
        'content' => 'Always enable 2FA on important accounts. Use authenticator apps instead of SMS when possible.',
        'category' => 'Account Security',
        'icon' => 'fas fa-shield-alt'
    ],
    [
        'title' => 'Regular Software Updates',
        'content' => 'Keep your operating system, applications, and antivirus software updated to patch security vulnerabilities.',
        'category' => 'System Security',
        'icon' => 'fas fa-sync-alt'
    ],
    [
        'title' => 'Phishing Awareness',
        'content' => 'Check email sender addresses, hover over links before clicking, and never share credentials via email.',
        'category' => 'Social Engineering',
        'icon' => 'fas fa-fish'
    ],
    [
        'title' => 'Network Security Basics',
        'content' => 'Use WPA3 encryption for WiFi, change default router passwords, and disable WPS.',
        'category' => 'Network Security',
        'icon' => 'fas fa-wifi'
    ],
    [
        'title' => 'Data Backup Strategy',
        'content' => 'Follow the 3-2-1 rule: 3 copies of data, 2 different media types, 1 off-site backup.',
        'category' => 'Data Protection',
        'icon' => 'fas fa-save'
    ],
    [
        'title' => 'CTF Challenge Strategies',
        'content' => 'Start with reconnaissance, examine all files, check for hidden data, and try different encoding methods.',
        'category' => 'CTF Techniques',
        'icon' => 'fas fa-flag'
    ],
    [
        'title' => 'Web Security Testing',
        'content' => 'Check for SQL injection, XSS vulnerabilities, directory traversal, and insecure file uploads.',
        'category' => 'Web Security',
        'icon' => 'fas fa-globe'
    ]
];

// Group tips by category
$tipsByCategory = [];
foreach ($tips as $tip) {
    $category = $tip['category'];
    if (!isset($tipsByCategory[$category])) {
        $tipsByCategory[$category] = [];
    }
    $tipsByCategory[$category][] = $tip;
}
?>

<h1 class="content-title">
    <i class="fas fa-lightbulb me-2"></i> Tips & Tricks
</h1>

<p class="text-muted mb-4">
    Practical cybersecurity advice and techniques to help you stay secure and improve your skills.
</p>

<div class="row">
    <?php foreach ($tipsByCategory as $category => $categoryTips): ?>
    <div class="col-lg-6 mb-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <?php echo htmlspecialchars($category); ?>
                    <span class="badge bg-light text-dark ms-2"><?php echo count($categoryTips); ?></span>
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <?php foreach ($categoryTips as $tip): ?>
                    <div class="list-group-item border-0 px-0">
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                <i class="<?php echo $tip['icon']; ?> fa-lg text-primary mt-1"></i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1"><?php echo htmlspecialchars($tip['title']); ?></h6>
                                <p class="mb-0 text-muted small"><?php echo htmlspecialchars($tip['content']); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-body">
        <h5 class="card-title">
            <i class="fas fa-graduation-cap me-2"></i> Learning Resources
        </h5>
        <div class="row">
            <div class="col-md-6">
                <h6>Recommended Websites</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="https://tryhackme.com" target="_blank" class="text-decoration-none">
                            <i class="fas fa-external-link-alt me-2"></i>TryHackMe
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="https://hackthebox.com" target="_blank" class="text-decoration-none">
                            <i class="fas fa-external-link-alt me-2"></i>HackTheBox
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="https://overthewire.org" target="_blank" class="text-decoration-none">
                            <i class="fas fa-external-link-alt me-2"></i>OverTheWire
                        </a>
                    </li>
                    <li>
                        <a href="https://cybrary.it" target="_blank" class="text-decoration-none">
                            <i class="fas fa-external-link-alt me-2"></i>Cybrary
                        </a>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <h6>Useful Tools</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <i class="fas fa-terminal me-2"></i>Burp Suite - Web vulnerability scanner
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-terminal me-2"></i>Nmap - Network discovery and security auditing
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-terminal me-2"></i>Wireshark - Network protocol analyzer
                    </li>
                    <li>
                        <i class="fas fa-terminal me-2"></i>Metasploit - Penetration testing framework
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>