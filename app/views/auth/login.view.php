<?= loadPartial("head"); ?>

<?= loadPartial("navbar"); ?>

<main class="auth-page">
    <div class="card auth-card">
        <header class="card-header auth-card-header">
            <h1 class="section-title auth-page-title">Sign in</h1>
            <p class="section-subtitle">Access your JobSeeker account</p>
        </header>

        <div class="card-content">
            <?php if (isset($error) && $error): ?>
                <div class="alert alert-error"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" class="input" required />
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••" class="input" required />
                </div>

                <button type="submit" class="btn btn-primary auth-submit-btn">
                    Sign in
                </button>

                <p class="auth-footer-text">
                    No account?
                    <a href="/auth/register">Create one</a>
                </p>
            </form>
        </div>
    </div>
</main>

<?= loadPartial("footer"); ?>