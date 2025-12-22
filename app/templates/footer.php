                    </div>
                    
                    <!-- Tips & Tricks Alert (Example) -->
                    <div class="alert alert-warning mt-4" role="alert" style="border-left: 4px solid #ffc107;">
                        <div class="d-flex">
                            <div class="me-3">
                                <i class="fas fa-lightbulb fa-lg"></i>
                            </div>
                            <div>
                                <h5 class="alert-heading">Today's Cyber Tip</h5>
                                <p class="mb-1">Always use strong, unique passwords for different accounts and enable two-factor authentication whenever possible.</p>
                                <small class="text-muted">Updated: <?php echo date('F j, Y'); ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Cyber Void</h5>
                    <p class="mb-3">A hands-on cybersecurity learning platform with file-driven content and challenges.</p>
                    <p class="small">
                        Built with PHP, Bootstrap 5 & Docker
                    </p>
                </div>
                <div class="col-md-3">
                    <h6>Quick Links</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="/">Home</a></li>
                        <li class="mb-2"><a href="/classes">Classes</a></li>
                        <li class="mb-2"><a href="/challenges">Challenges</a></li>
                        <li class="mb-2"><a href="/tips">Tips & Tricks</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6>Connect</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="https://github.com/yourusername/cyber-void">
                                GitHub
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://discord.gg/cybervoid">
                                Discord
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="mailto:contact@cybervoid.com">
                                Contact
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <hr class="my-3" style="border-color: #4a5568;">
            <div class="text-center small">
                &copy; <?php echo date('Y'); ?> Cyber Void. All rights reserved. | 
                <a href="/privacy">Privacy Policy</a> | 
                <a href="/terms">Terms of Service</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
<script>
    // Initialize collapsible sections
    function initCollapsibleSections() {
        const collapseBtns = document.querySelectorAll('.collapse-btn');
        
        collapseBtns.forEach(btn => {
            btn.addEventListener('click', function() {
                const icon = this.querySelector('.collapse-icon');
                icon.classList.toggle('collapsed');
            });
        });
        
        // Set initial state for collapse icons
        document.querySelectorAll('.collapse').forEach(collapse => {
            const btn = collapse.previousElementSibling;
            const icon = btn.querySelector('.collapse-icon');
            
            if (!collapse.classList.contains('show')) {
                icon.classList.add('collapsed');
            }
        });
    }
    
    // Add click handlers to dashboard challenge items
    function initDashboardChallenges() {
        document.querySelectorAll('.dashboard-challenge-item').forEach(item => {
            item.addEventListener('click', function() {
                const challengeName = this.querySelector('.fw-medium').textContent;
                console.log('Opening dashboard challenge:', challengeName);
                // In real app: window.location.href = '/challenges/' + challengeId;
            });
        });
    }
    
    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function() {
        initCollapsibleSections();
        initDashboardChallenges();
    });
</script>
</body>
</html>