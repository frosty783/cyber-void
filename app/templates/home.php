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
                <div class="list-group list-group-flush">
                    <!-- Challenge items with difficulty badges -->
                    <button class="list-group-item list-group-item-action dashboard-challenge-item" onclick="window.location.href='/challenges/hello-world'">
                        <div>
                            <span class="fw-medium">Hello World Intrusion</span>
                            <small class="text-muted ms-2 d-block d-md-inline">A basic challenge to get started</small>
                        </div>
                        <span class="badge badge-easy">Easy</span>
                    </button>
                    
                    <button class="list-group-item list-group-item-action dashboard-challenge-item" onclick="window.location.href='/challenges/cybernet'">
                        <div>
                            <span class="fw-medium">Cybernet Shockwave Report</span>
                            <small class="text-muted ms-2 d-block d-md-inline">Analyze network traffic</small>
                        </div>
                        <span class="badge badge-easy">Easy</span>
                    </button>
                    
                    <button class="list-group-item list-group-item-action dashboard-challenge-item" onclick="window.location.href='/challenges/famous-quotes'">
                        <div>
                            <span class="fw-medium">Famous Quotes Decoder</span>
                            <small class="text-muted ms-2 d-block d-md-inline">Cryptography challenge</small>
                        </div>
                        <span class="badge badge-medium">Medium</span>
                    </button>
                    
                    <button class="list-group-item list-group-item-action dashboard-challenge-item" onclick="window.location.href='/challenges/whats-noise'">
                        <div>
                            <span class="fw-medium">What is that noise?</span>
                            <small class="text-muted ms-2 d-block d-md-inline">Audio steganography</small>
                        </div>
                        <span class="badge badge-medium">Medium</span>
                    </button>
                    
                    <button class="list-group-item list-group-item-action dashboard-challenge-item" onclick="window.location.href='/challenges/lect-messenger'">
                        <div>
                            <span class="fw-medium">Lect Messenger Analysis</span>
                            <small class="text-muted ms-2 d-block d-md-inline">Reverse engineering</small>
                        </div>
                        <span class="badge badge-hard">Hard</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <!-- Removed progress card -->
        
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h5 class="card-title">Quick Stats</h5>
                <div class="text-center my-4">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <div class="display-6 text-primary">12</div>
                            <div class="text-muted small">Classes</div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="display-6 text-success">24</div>
                            <div class="text-muted small">Challenges</div>
                        </div>
                        <div class="col-6">
                            <div class="display-6 text-warning">3</div>
                            <div class="text-muted small">Difficulty Levels</div>
                        </div>
                        <div class="col-6">
                            <div class="display-6 text-info">7</div>
                            <div class="text-muted small">Categories</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h5 class="card-title">Upcoming Sessions</h5>
                <div class="mt-3">
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <div class="bg-info text-white rounded p-2 text-center" style="width: 50px;">
                                <div class="fw-bold">15</div>
                                <div class="small">MAR</div>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Class 3: Cryptography</h6>
                            <small class="text-muted">2:00 PM - 3:30 PM</small>
                            <div class="mt-1">
                                <span class="badge bg-light text-dark">Discord Live</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <div class="bg-primary text-white rounded p-2 text-center" style="width: 50px;">
                                <div class="fw-bold">18</div>
                                <div class="small">MAR</div>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Challenge Walkthrough</h6>
                            <small class="text-muted">6:00 PM - 7:00 PM</small>
                            <div class="mt-1">
                                <span class="badge bg-light text-dark">Q&A Session</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="bg-warning text-dark rounded p-2 text-center" style="width: 50px;">
                                <div class="fw-bold">22</div>
                                <div class="small">MAR</div>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0">Class 4: Web Security</h6>
                            <small class="text-muted">4:00 PM - 5:30 PM</small>
                            <div class="mt-1">
                                <span class="badge bg-light text-dark">Hands-on Lab</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tips & Tricks Alert -->
