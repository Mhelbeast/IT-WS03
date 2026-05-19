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
        <div class="section-header" style="justify-content: center; border: 1px solid #d6dce8; padding: 1rem; border-radius: 0.625rem; margin-bottom: 1rem;">
            <h2 class="section-title" style="font-size: 1.8rem;">Recent Jobs</h2>
        </div>
        <div class="jobs-grid mb-6">
            <?php foreach (isset($listings) ? $listings : [] as $listing): ?>
                <?php loadPartial('job-card', ['job' => $listing]); ?>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center;">
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