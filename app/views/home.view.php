<?= loadPartial("head"); ?>

<!-- Nav -->
<?= loadPartial("navbar"); ?>

<!-- Showcase -->
<?= loadPartial("showcase-search"); ?>

<!-- Top Banner -->
<?= loadPartial("top-banner"); ?>

<!-- Job Listings -->
<section class="page-section">
    <div class="site-container">
        <div class="section-header recent-jobs-header">
            <h2 class="section-title recent-jobs-title">Recent Jobs</h2>
        </div>
        <div class="jobs-grid mb-6">
            <?php foreach (isset($listings) ? $listings : [] as $listing): ?>
                <?php loadPartial('job-card', ['job' => $listing]); ?>
            <?php endforeach; ?>
        </div>

        <div class="jobs-center-container">
            <a href="listings" class="link-more">
                <i class="fa fa-arrow-alt-circle-right"></i>
                Show All Jobs
            </a>
        </div>
    </div>
</section>

<!-- Bottom Banner -->
<?= loadPartial("bottom-banner"); ?>

<!-- Footer -->
<?= loadPartial("footer"); ?>