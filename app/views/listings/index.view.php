<?= loadPartial("head"); ?>

<?= loadPartial("navbar"); ?>

<main class="page-section">
    <div class="site-container">
        <header class="section-header">
            <div>
                <h1 class="section-title">Job listings</h1>
                <p class="section-subtitle">Filter by keyword and location</p>
            </div>
            <a href="/listings/create" class="btn btn-primary btn-sm">
                <i class="fa fa-plus" aria-hidden="true"></i> Post a Job
            </a>
        </header>

        <?php
            $kw = $keywords ?? ($_GET['keywords'] ?? '');
            $loc = $location ?? ($_GET['location'] ?? '');
        ?>

        <form method="GET" action="/listings" class="filters-bar">
            <input type="text" name="keywords" placeholder="Keywords" value="<?= htmlspecialchars($kw) ?>" class="input" />
            <input type="text" name="location" placeholder="Location" value="<?= htmlspecialchars($loc) ?>" class="input" />
            <div class="filters-bar__actions">
                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                <a href="/listings" class="btn btn-secondary btn-sm">Clear</a>
            </div>
        </form>

        <?php if (empty($listings)): ?>
            <div class="empty-state">No job listings match your search.</div>
        <?php else: ?>
            <div class="jobs-grid">
                <?php foreach ($listings as $job): ?>
                    <?php loadPartial('job-card', ['job' => $job]); ?>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<?= loadPartial("footer"); ?>
