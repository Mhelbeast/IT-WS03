<?= loadPartial("head"); ?>
<?= loadPartial("navbar"); ?>

<main class="auth-page">
    <div class="card auth-card auth-card--wide">
        <header class="card-header auth-card-header">
            <h1 class="section-title auth-page-title">Post a job listing</h1>
            <p class="section-subtitle">Share role details so candidates can find you</p>
        </header>

        <div class="card-content">
            <form method="POST">
                <p class="form-section-title">Job information</p>

                <div class="form-group">
                    <label class="form-label" for="title">Job title</label>
                    <input type="text" id="title" name="title" placeholder="e.g. Senior PHP Developer" class="input" />
                </div>
                <div class="form-group">
                    <label class="form-label" for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Role summary and responsibilities" class="input"></textarea>
                </div>
                <div class="form-row-2">
                    <div class="form-group">
                        <label class="form-label" for="salary">Annual salary</label>
                        <input type="text" id="salary" name="salary" placeholder="75000" class="input" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="requirements">Requirements</label>
                        <input type="text" id="requirements" name="requirements" placeholder="Key skills or experience" class="input" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="benefits">Benefits</label>
                    <input type="text" id="benefits" name="benefits" placeholder="Health, remote, PTO, etc." class="input" />
                </div>

                <p class="form-section-title">Company &amp; location</p>

                <div class="form-group">
                    <label class="form-label" for="company">Company name</label>
                    <input type="text" id="company" name="company" class="input" />
                </div>
                <div class="form-row-2">
                    <div class="form-group">
                        <label class="form-label" for="city">City</label>
                        <input type="text" id="city" name="city" class="input" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="state">State</label>
                        <input type="text" id="state" name="state" class="input" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="address">Address</label>
                    <input type="text" id="address" name="address" class="input" />
                </div>
                <div class="form-row-2">
                    <div class="form-group">
                        <label class="form-label" for="phone">Phone</label>
                        <input type="text" id="phone" name="phone" class="input" />
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="email">Application email</label>
                        <input type="email" id="email" name="email" class="input" />
                    </div>
                </div>

                <div class="listing-form-buttons">
                    <button type="submit" class="btn btn-primary btn-full-width">Save listing</button>
                    <a href="/" class="btn btn-outline btn-full-width-centered">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</main>

<?= loadPartial("footer"); ?>