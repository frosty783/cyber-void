<?php
$classId = $params[0] ?? null;
$class = $fileLoader->getClass($classId);

if (!$class) {
    echo '<div class="alert alert-danger">Class not found.</div>';
    return;
}

// Check if Google Doc URL exists
if (empty($class['google_doc_url'])) {
    echo '<div class="alert alert-warning">No Google Doc available for this class yet.</div>';
    return;
}
?>

<h1 class="content-title">
    <?php echo htmlspecialchars($class['title']); ?>
    <span class="badge bg-primary ms-2">Class <?php echo $class['id']; ?></span>
</h1>

<div class="row">
    <!-- Google Doc Full Width -->
    <div class="col-12">
        <!-- Google Doc Embed Card -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-0">
                        <i class="fab fa-google me-2"></i><?php echo htmlspecialchars($class['title']); ?>
                    </h5>
                    <?php if (!empty($class['description'])): ?>
                    <small class="text-light"><?php echo htmlspecialchars($class['description']); ?></small>
                    <?php endif; ?>
                </div>
                <div class="btn-group" role="group">
                    <a href="<?php echo htmlspecialchars($class['google_doc_url']); ?>" 
                       target="_blank" 
                       class="btn btn-sm btn-light">
                        <i class="fas fa-external-link-alt me-1"></i>Open in New Tab
                    </a>
                    <?php if (strpos($class['google_doc_url'], '/edit') !== false): ?>
                    <a href="<?php echo htmlspecialchars(str_replace('/edit', '/copy', $class['google_doc_url'])); ?>" 
                       target="_blank" 
                       class="btn btn-sm btn-success">
                        <i class="fas fa-copy me-1"></i>Make a Copy
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body p-0" style="height: 70vh; min-height: 600px;">
                <!-- Google Doc Embed -->
                <?php
                // Convert edit URL to preview URL for embedding
                $previewUrl = str_replace('/edit', '/preview', $class['google_doc_url']);
                ?>
                <iframe src="<?php echo htmlspecialchars($previewUrl); ?>" 
                        style="width: 100%; height: 100%; border: none;"
                        allow="autoplay"
                        title="Google Document: <?php echo htmlspecialchars($class['title']); ?>">
                </iframe>
            </div>
            <div class="card-footer bg-light">
                <div class="row">
                    <div class="col-md-6">
                        <small class="text-muted">
                            <i class="fas fa-info-circle me-1"></i>
                            Document updates in real-time. Changes are automatically saved.
                        </small>
                    </div>
                    <div class="col-md-6 text-end">
                        <!-- Navigation -->
                        <div class="btn-group btn-group-sm" role="group">
                            <?php if ($class['id'] > 1): ?>
                            <a href="/classes/<?php echo $class['id'] - 1; ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>Previous
                            </a>
                            <?php endif; ?>
                            
                            <?php 
                            $nextClass = $fileLoader->getClass($class['id'] + 1);
                            if ($nextClass): ?>
                            <a href="/classes/<?php echo $class['id'] + 1; ?>" class="btn btn-outline-primary">
                                Next<i class="fas fa-arrow-right ms-1"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Class Info Panel - REMOVED REQUEST ACCESS BUTTON -->
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-clock me-2 text-primary"></i>Class Details
                        </h6>
                        <ul class="list-unstyled">
                            <?php if (!empty($class['estimated_time'])): ?>
                            <li class="mb-2">
                                <strong>Duration:</strong> <?php echo htmlspecialchars($class['estimated_time']); ?>
                            </li>
                            <?php endif; ?>
                            <?php if (!empty($class['prerequisites'])): ?>
                            <li class="mb-2">
                                <strong>Prerequisites:</strong> <?php echo htmlspecialchars($class['prerequisites']); ?>
                            </li>
                            <?php endif; ?>
                            <li class="mb-2">
                                <strong>Format:</strong> Google Document
                            </li>
                            <li>
                                <strong>Access:</strong> 
                                <span class="badge bg-info">Read Only</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fas fa-tools me-2 text-primary"></i>Document Tools
                        </h6>
                        <div class="d-grid gap-2">
                            <!-- FIXED PDF DOWNLOAD LINK -->
                            <?php
                            // Proper way to create PDF download link
                            $docId = '';
                            if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $class['google_doc_url'], $matches)) {
                                $docId = $matches[1];
                            } elseif (preg_match('/document\/d\/([a-zA-Z0-9_-]+)/', $class['google_doc_url'], $matches)) {
                                $docId = $matches[1];
                            }
                            
                            if (!empty($docId)): 
                            ?>
                            <a href="https://docs.google.com/document/d/<?php echo $docId; ?>/export?format=pdf" 
                               target="_blank" 
                               class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-download me-1"></i>Download as PDF
                            </a>
                            <?php endif; ?>
                            
                            <!-- Make a Copy button -->
                            <?php if (strpos($class['google_doc_url'], '/edit') !== false): ?>
                            <a href="<?php echo htmlspecialchars(str_replace('/edit', '/copy', $class['google_doc_url'])); ?>" 
                               target="_blank" 
                               class="btn btn-outline-success btn-sm">
                                <i class="fas fa-copy me-1"></i>Make Your Own Copy
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="fab fa-discord me-2 text-primary"></i>Live Support
                        </h6>
                        <p class="small">Join our Discord community for:</p>
                        <ul class="small">
                            <li>Live Q&A sessions</li>
                            <li>Discussion with peers</li>
                            <li>Additional resources</li>
                            <li>Challenge help</li>
                        </ul>
                        <div class="d-grid">
                            <a href="https://discord.gg/cybervoid" 
                               target="_blank" 
                               class="btn btn-primary btn-sm">
                                <i class="fab fa-discord me-1"></i> Join Discord
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Print Functionality -->
<script>
function printDocument() {
    // Get the iframe
    const iframe = document.querySelector('iframe');
    if (iframe && iframe.contentWindow) {
        // Try to print the iframe content
        iframe.contentWindow.print();
    } else {
        // Fallback: open the document in new tab and print
        const docUrl = "<?php echo htmlspecialchars($class['google_doc_url']); ?>";
        window.open(docUrl, '_blank').print();
    }
}

// Alternative: Direct print button for iframe
function setupPrintButton() {
    const printBtn = document.querySelector('[onclick="printDocument()"]');
    if (printBtn) {
        printBtn.addEventListener('click', function(e) {
            e.preventDefault();
            printDocument();
        });
    }
}

document.addEventListener('DOMContentLoaded', setupPrintButton);
</script>

<style>
/* Additional styling for better Google Docs experience */
.google-doc-toolbar {
    background: #f8f9fa;
    padding: 10px;
    border-bottom: 1px solid #dee2e6;
}

/* Print styles */
@media print {
    .card-header, .card-footer, .row.mt-4 {
        display: none !important;
    }
    
    iframe {
        height: 100vh !important;
        min-height: auto !important;
        border: none !important;
    }
}

/* Mobile responsive */
@media (max-width: 768px) {
    .card-body.p-0 {
        height: 60vh !important;
        min-height: 400px !important;
    }
    
    .card-header .btn-group {
        flex-wrap: wrap;
        margin-top: 0.5rem;
    }
    
    .card-header .btn-group .btn {
        margin-bottom: 0.25rem;
    }
    
    .row.mt-4 .col-md-4 {
        margin-bottom: 1rem;
    }
}
</style>