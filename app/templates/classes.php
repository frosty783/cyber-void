<?php
$classes = $fileLoader->getClasses();
?>

<h1 class="content-title">
    All Classes
</h1>

<div class="row">
    <?php foreach ($classes as $class): ?>
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <h5 class="card-title mb-0"><?php echo htmlspecialchars($class['title']); ?></h5>
                    <span class="badge bg-primary">Class <?php echo $class['id']; ?></span>
                </div>
                
                <?php if (!empty($class['description'])): ?>
                <p class="card-text text-muted small"><?php echo htmlspecialchars($class['description']); ?></p>
                <?php endif; ?>
                
                <div class="mt-3">
                    <?php if (!empty($class['files'])): ?>
                    <div class="mb-2">
                        <small class="text-muted">Materials: <?php echo count($class['files']); ?> files</small>
                    </div>
                    <?php endif; ?>
                    
                    <a href="/classes/<?php echo $class['id']; ?>" class="btn btn-sm btn-outline-primary">
                        View Class
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php if (empty($classes)): ?>
<div class="alert alert-info">
    <i class="fas fa-info-circle me-2"></i>
    No classes found. Please add some class content to the classes/ folder.
</div>
<?php endif; ?>