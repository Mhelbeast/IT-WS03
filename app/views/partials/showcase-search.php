<section class="hero showcase relative bg-cover bg-center bg-no-repeat flex items-center">
    <div class="overlay"></div>
    <div class="site-container hero__content">
        <h2 class="hero__title">Find your Dream Job</h2>
        <form method="GET" action="/listings" class="input-search-group">
            <input
                type="text"
                name="keywords"
                placeholder="Job title or keyword"
                value="<?= htmlspecialchars($_GET['keywords'] ?? '') ?>"
                class="input" />
            <input
                type="text"
                name="location"
                placeholder="City or state"
                value="<?= htmlspecialchars($_GET['location'] ?? '') ?>"
                class="input" />
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-search" aria-hidden="true"></i> Search
            </button>
        </form>
    </div>
</section>