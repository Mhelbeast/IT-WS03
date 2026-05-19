<?= loadPartial("head"); ?>

<?= loadPartial("navbar"); ?>

<main class="auth-page">
    <div class="card auth-card">
        <header class="card-header" style="text-align: center; padding-bottom: 0;">
            <h1 class="section-title" style="font-size: 1.25rem;">Create account</h1>
            <p class="section-subtitle">Join JobSeeker to post and manage listings</p>
        </header>

        <div class="card-content">
            <?php if (isset($errors) && count($errors)): ?>
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 1.25rem;">
                        <?php foreach ($errors as $err): ?>
                            <li><?= htmlspecialchars($err) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form method="POST">
                <div class="form-row-2">
                    <div class="form-group">
                        <label class="form-label" for="first_name">First name</label>
                        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($old['first_name'] ?? '') ?>" class="input" required />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="last_name">Last name</label>
                        <input type="text" id="last_name" name="last_name" value="<?= htmlspecialchars($old['last_name'] ?? '') ?>" class="input" required />
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($old['email'] ?? '') ?>" class="input" required />
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" id="password" name="password" class="input" required />
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirm">Confirm password</label>
                    <input type="password" id="password_confirm" name="password_confirm" class="input" required />
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 0.5rem;">
                    Register
                </button>

                <p style="text-align: center; margin-top: 1rem; font-size: 0.8125rem; color: var(--muted-foreground);">
                    Already have an account?
                    <a href="/auth/login">Sign in</a>
                </p>
            </form>
        </div>
    </div>
</main>

<?= loadPartial("footer"); ?>