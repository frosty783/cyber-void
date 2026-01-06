</div>
</div>
</div>
</div>
</div>



<button id="open-terminal">Terminal</button>

<div id="terminal-drawer">
  <iframe src="/terminal-ui/" id="terminal-frame"></iframe>
</div>

<script>
  const btn = document.getElementById("open-terminal");
  const drawer = document.getElementById("terminal-drawer");

  btn.addEventListener("click", () => {
    drawer.classList.toggle("open");
  });
</script>



<!-- Footer -->
<footer class="footer">
    <div class="container">
        
        
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
            btn.addEventListener('click', function () {
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


    // Real-time dashboard updates - ADD THIS FUNCTION
    // Replace the updateDashboardStats function with this SIMPLE version:
    function updateDashboardStats() {
        // Simulate API call - just update numbers from current page data
        const classElements = document.querySelectorAll('.display-6.text-primary');
        const challengeElements = document.querySelectorAll('.display-6.text-success');

        if (classElements.length > 0 && challengeElements.length > 0) {
            // Just add a visual indicator that stats are "live"
            const sessionBadge = document.querySelector('.card-title .badge');
            if (sessionBadge) {
                sessionBadge.classList.toggle('bg-primary');
                sessionBadge.classList.toggle('bg-success');
                sessionBadge.textContent = 'Live Now';
                setTimeout(() => {
                    sessionBadge.textContent = 'Live';
                }, 2000);
            }

            // Add a subtle pulse animation to stats
            classElements.forEach(el => {
                el.classList.add('text-pulse');
                setTimeout(() => el.classList.remove('text-pulse'), 1000);
            });

            console.log('Dashboard stats refreshed at:', new Date().toLocaleTimeString());
        }
    }

    // Update every 30 seconds
    setInterval(updateDashboardStats, 30000);

    // Add this CSS for pulse animation
    const style = document.createElement('style');
    style.textContent = `
    .text-pulse {
        animation: pulse 1s ease-in-out;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }
    
    .badge.bg-success {
        animation: glow 2s infinite alternate;
    }
    
    @keyframes glow {
        from { box-shadow: 0 0 5px #198754; }
        to { box-shadow: 0 0 15px #198754; }
    }
`;
    document.head.appendChild(style);

    // Add click handlers to dashboard challenge items
    function initDashboardChallenges() {

    }

    // Initialize when page loads
    document.addEventListener('DOMContentLoaded', function () {
        initCollapsibleSections();
        updateDashboardStats();
    });


    // Dashboard interactivity
    document.addEventListener('DOMContentLoaded', function () {
        // Animate stats on scroll
        const statsElements = document.querySelectorAll('.display-6');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.5 });

        statsElements.forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(el);
        });

        // Challenge item click handlers
        document.querySelectorAll('.dashboard-challenge-item').forEach(item => {
            item.addEventListener('click', function (e) {
                if (!e.target.closest('a')) {
                    this.style.backgroundColor = '#e3f2fd';
                    setTimeout(() => {
                        window.location.href = this.getAttribute('href') ||
                            this.querySelector('a').getAttribute('href');
                    }, 300);
                }
            });
        });

        // Update challenge counts with animation
        function animateValue(element, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                element.textContent = value;
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Animate the main stats
        setTimeout(() => {
            const classCount = document.querySelector('.display-6.text-primary');
            const challengeCount = document.querySelector('.display-6.text-success');

            if (classCount && challengeCount) {
                const classVal = parseInt(classCount.textContent);
                const challengeVal = parseInt(challengeCount.textContent);

                if (classVal > 0) animateValue(classCount, 0, classVal, 1000);
                if (challengeVal > 0) animateValue(challengeCount, 0, challengeVal, 1000);
            }
        }, 500);

        // Auto-refresh upcoming sessions every 5 minutes
        setInterval(() => {
            const sessionBadge = document.querySelector('.card-title .badge');
            if (sessionBadge) {
                sessionBadge.classList.toggle('bg-primary');
                sessionBadge.classList.toggle('bg-success');
            }
        }, 300000); // 5 minutes

        // Daily tip refresh at midnight
        function checkForNewDay() {
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();

            if (hours === 0 && minutes === 0) {
                location.reload(); // Reload for new daily tip
            }
        }

        // Check every minute
        setInterval(checkForNewDay, 60000);
    });
</script>





</body>

</html>