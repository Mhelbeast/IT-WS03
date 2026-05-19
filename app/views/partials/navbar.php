<header class="site-header">
    <div class="site-container site-header__inner">
        <a href="/" class="site-logo">JobSeeker</a>

        <details class="nav-toggle">
            <summary aria-label="Open menu"><i class="fa fa-bars" aria-hidden="true"></i></summary>
            <div class="nav-toggle__panel">
                <a href="/myblog" class="btn btn-sm" title="My Blog"><i class="fa fa-user" aria-hidden="true"></i> Blog</a>
                <a href="/ternary" class="btn btn-sm" title="Ternary"><i class="fa fa-code" aria-hidden="true"></i> Ternary</a>
                <a href="/listings/create" class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true"></i> Post a Job</a>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <a href="/auth/login">Login</a>
                    <a href="/auth/register">Register</a>
                <?php else: ?>
                    <a href="/auth/login">Logout</a>
                <?php endif; ?>
            </div>
        </details>

        <nav class="site-nav site-nav--desktop" aria-label="Main">
            <a href="/myblog" title="My Blog"><i class="fa fa-user" aria-hidden="true"></i></a>
            <a href="/ternary" title="Ternary"><i class="fa fa-code" aria-hidden="true"></i></a>
            <a href="/listings/create" class="btn btn-primary btn-sm">
                <i class="fa fa-plus" aria-hidden="true"></i> Post a Job
            </a>
            <?php if (!isset($_SESSION['user_id'])): ?>
                <a href="/auth/login">Login</a>
                <a href="/auth/register">Register</a>
            <?php else: ?>
                <a href="/auth/login">Logout</a>
            <?php endif; ?>
        </nav>
    </div>
</header>