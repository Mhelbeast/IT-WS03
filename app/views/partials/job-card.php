<?php

/** @var stdClass $job */
?>
<?php
$location = htmlspecialchars($job->city ?: $job->state ?: $job->address ?: 'Remote');
$salary = '$' . htmlspecialchars(number_format((float)$job->salary, 0));
?>
<article class="job-card">
    <h2 class="job-card__title">
        <a href="/listings/<?= htmlspecialchars($job->id) ?>"><?= htmlspecialchars($job->title) ?></a>
    </h2>
    <?php if (!empty($job->company)): ?>
        <p class="job-card__company"><?= htmlspecialchars($job->company) ?></p>
    <?php endif; ?>
    <div class="job-card__meta">
        <span class="badge badge-muted"><i class="fa fa-location-dot" aria-hidden="true"></i> <?= $location ?></span>
        <span class="badge badge-accent"><?= $salary ?></span>
    </div>
    <?php
    $desc = strip_tags((string) $job->description);
    if (strlen($desc) > 140) {
        $desc = substr($desc, 0, 137) . '...';
    }
    ?>
    <p class="job-card__desc"><?= htmlspecialchars($desc) ?></p>
    <div class="job-card__footer">
        <a href="/listings/<?= htmlspecialchars($job->id) ?>" class="btn btn-outline btn-sm btn-full-width">
            View details
        </a>
    </div>
</article>