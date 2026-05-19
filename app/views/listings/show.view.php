<?= loadPartial("head"); ?>
<?= loadPartial("navbar"); ?>

<main class="page-section">
    <div class="site-container">
        <a href="/listings" class="btn btn-ghost btn-sm listing-back-btn">
            <i class="fa fa-arrow-left" aria-hidden="true"></i> Back to listings
        </a>

        <article class="card">
            <header class="card-header">
                <h1 class="listing-detail-title"><?= htmlspecialchars($listing->title) ?></h1>
                <?php if (!empty($listing->company)): ?>
                    <p class="section-subtitle listing-company-name"><?= htmlspecialchars($listing->company) ?></p>
                <?php endif; ?>
            </header>

            <div class="card-content">
                <dl class="detail-meta">
                    <div class="detail-meta__item">
                        <dt class="detail-meta__label">Location</dt>
                        <dd class="detail-meta__value"><?= htmlspecialchars($listing->city ?: $listing->state ?: $listing->address) ?></dd>
                    </div>
                    <div class="detail-meta__item">
                        <dt class="detail-meta__label">Salary</dt>
                        <dd class="detail-meta__value">$<?= htmlspecialchars(number_format((float)$listing->salary, 0)) ?></dd>
                    </div>
                    <div class="detail-meta__item">
                        <dt class="detail-meta__label">Contact</dt>
                        <dd class="detail-meta__value detail-meta__value--small"><?= htmlspecialchars($listing->email) ?></dd>
                    </div>
                </dl>

                <?php if (!empty($listing->description)): ?>
                    <section class="detail-block">
                        <h2>Description</h2>
                        <p class="detail-block-text"><?= nl2br(htmlspecialchars($listing->description)) ?></p>
                    </section>
                <?php endif; ?>

                <?php if (!empty($listing->requirements)): ?>
                    <section class="detail-block">
                        <h2>Requirements</h2>
                        <p class="detail-block-text"><?= nl2br(htmlspecialchars($listing->requirements)) ?></p>
                    </section>
                <?php endif; ?>

                <?php if (!empty($listing->benefits)): ?>
                    <section class="detail-block">
                        <h2>Benefits</h2>
                        <p class="detail-block-text"><?= nl2br(htmlspecialchars($listing->benefits)) ?></p>
                    </section>
                <?php endif; ?>

                <section class="detail-block">
                    <h2>How to apply</h2>
                    <p class="detail-block-text">
                        Email: <a href="mailto:<?= htmlspecialchars($listing->email) ?>"><?= htmlspecialchars($listing->email) ?></a>
                        <?php if (!empty($listing->phone)): ?>
                            · Phone: <?= htmlspecialchars($listing->phone) ?>
                        <?php endif; ?>
                    </p>
                </section>
            </div>
        </article>
    </div>
</main>

<?= loadPartial("footer"); ?>