<?php
$classId = $params[0] ?? null;
$class = $fileLoader->getClass($classId);

if (!$class) {
    echo '<div class="alert alert-danger">Class not found.</div>';
    return;
}
?>

<h1 class="content-title">
    <?php echo htmlspecialchars($class['title']); ?>
    <span class="badge bg-primary ms-2">Class <?php echo $class['id']; ?></span>
</h1>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <?php if (!empty($class['content'])): ?>
                    <div class="class-content">
                        <?php 
                        // Convert Markdown to HTML (simple conversion)
                        $content = htmlspecialchars($class['content']);
                        $content = preg_replace('/# (.*)/', '<h2>$1</h2>', $content);
                        $content = preg_replace('/## (.*)/', '<h3>$1</h3>', $content);
                        $content = preg_replace('/### (.*)/', '<h4>$1</h4>', $content);
                        $content = str_replace("\n", '<br>', $content);
                        echo $content;
                        ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        No content available for this class yet.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-body">
                <h6 class="card-title mb-3">Class Materials</h6>
                
                <?php if (!empty($class['files'])): ?>
                    <div class="list-group list-group-flush">
                        <?php foreach ($class['files'] as $file): ?>
                        <a href="/<?php echo $file['path']; ?>" 
                           target="_blank" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fas fa-file me-2 text-muted"></i>
                                <?php echo htmlspecialchars($file['name']); ?>
                            </div>
                            <small class="text-muted"><?php echo round($file['size'] / 1024, 1); ?> KB</small>
                        </a>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-muted small">No additional materials for this class.</p>
                <?php endif; ?>
                
                <div class="mt-4">
                    <div class="d-grid">
                        <a href="https://discord.gg/cybervoid" 
                           target="_blank" 
                           class="btn btn-primary">
                            <i class="fab fa-discord me-1"></i> Join Live Session
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <h6 class="card-title mb-3">Navigation</h6>
                <div class="d-grid gap-2">
                    <?php if ($class['id'] > 1): ?>
                    <a href="/classes/<?php echo $class['id'] - 1; ?>" class="btn btn-outline-secondary">
                        ← Previous Class
                    </a>
                    <?php endif; ?>
                    
                    <?php 
                    $nextClass = $fileLoader->getClass($class['id'] + 1);
                    if ($nextClass): ?>
                    <a href="/classes/<?php echo $class['id'] + 1; ?>" class="btn btn-outline-primary">
                        Next Class →
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>