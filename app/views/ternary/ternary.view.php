<?= loadPartial("head"); ?>

<?= loadPartial("navbar"); ?>

<?php
$salaryInput = isset($_GET['salary']) ? trim((string) $_GET['salary']) : '';
$workMode = $_GET['mode'] ?? 'remote';
$experience = $_GET['experience'] ?? 'junior';
$hasPortfolio = ($_GET['portfolio'] ?? '') === 'yes';
$workMode = in_array($workMode, ['remote', 'hybrid', 'onsite'], true) ? $workMode : 'remote';
$experience = in_array($experience, ['junior', 'mid', 'senior'], true) ? $experience : 'junior';

$salary = is_numeric($salaryInput) ? (float) $salaryInput : null;
$modeLabel = $workMode === 'remote' ? 'Remote-first' : ($workMode === 'hybrid' ? 'Hybrid' : 'On-site');
$experienceLabel = $experience === 'senior' ? 'Senior' : ($experience === 'mid' ? 'Mid-level' : 'Junior');
$baseScore = $salary !== null ? ($salary >= 90000 ? 38 : ($salary >= 55000 ? 26 : 16)) : 0;
$modeScore = $workMode === 'remote' ? 24 : ($workMode === 'hybrid' ? 18 : 12);
$experienceScore = $experience === 'senior' ? 24 : ($experience === 'mid' ? 18 : 12);
$portfolioScore = $hasPortfolio ? 14 : 4;
$fitScore = min(100, $baseScore + $modeScore + $experienceScore + $portfolioScore);

// Job seeker suitability content
$suitability = $salary !== null ? ($fitScore >= 78 ? 'Highly suitable' : ($fitScore >= 55 ? 'Moderately suitable' : 'Low suitability')) : null;
$isHighSuitability = $fitScore >= 78;
$isMidSuitability = $fitScore >= 55 && $fitScore < 78;
$isLowSuitability = $fitScore < 55;
$advice = $salary !== null
    ? ($fitScore >= 78
        ? 'Apply confidently and highlight your strengths.'
        : ($fitScore >= 55
            ? 'Consider improving skills or portfolio before applying.'
            : 'Focus on gaining experience before pursuing this role.'))
    : null;
?>

<main class="page-section">
    <div class="site-container">
        <header class="section-header">
            <div>
                <h1 class="section-title">Job Seeker Suitability</h1>
                <p class="section-subtitle">A simple tool that evaluates a job seeker's fit for a role</p>
            </div>
        </header>

        <!-- Form Section -->
        <div style="margin-bottom: 3rem;">
            <form method="GET" action="/ternary" style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 2rem;">
                <div>
                    <label style="display: block; font-size: 0.75rem; color: var(--muted-foreground); font-weight: 600; margin-bottom: 0.5rem; text-transform: uppercase;">Salary</label>
                    <input id="salary" name="salary" type="number" min="0" step="1000" value="<?= htmlspecialchars($salaryInput) ?>" placeholder="75000" class="input" />
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; color: var(--muted-foreground); font-weight: 600; margin-bottom: 0.5rem; text-transform: uppercase;">Work Mode</label>
                    <select id="mode" name="mode" class="input">
                        <option value="remote" <?= $workMode === 'remote' ? 'selected' : '' ?>>Remote</option>
                        <option value="hybrid" <?= $workMode === 'hybrid' ? 'selected' : '' ?>>Hybrid</option>
                        <option value="onsite" <?= $workMode === 'onsite' ? 'selected' : '' ?>>On-site</option>
                    </select>
                </div>
                <div>
                    <label style="display: block; font-size: 0.75rem; color: var(--muted-foreground); font-weight: 600; margin-bottom: 0.5rem; text-transform: uppercase;">Experience</label>
                    <select id="experience" name="experience" class="input">
                        <option value="junior" <?= $experience === 'junior' ? 'selected' : '' ?>>Junior</option>
                        <option value="mid" <?= $experience === 'mid' ? 'selected' : '' ?>>Mid-level</option>
                        <option value="senior" <?= $experience === 'senior' ? 'selected' : '' ?>>Senior</option>
                    </select>
                </div>
                <div style="display: flex; gap: 0.5rem; align-items: flex-end;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Analyze</button>
                    <a href="/ternary" class="btn btn-secondary" style="padding: 0.625rem 1rem;">Reset</a>
                </div>
            </form>

            <!-- Results Section -->
            <?php if ($salary !== null): ?>
                <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 2rem; align-items: start; margin-bottom: 2rem;">
                    <!-- Score Gauge -->
                    <div style="text-align: center; padding: 2rem; background: linear-gradient(135deg, var(--muted) 0%, transparent 100%); border-radius: var(--radius); border: 1px solid var(--border);">
                        <div style="position: relative; width: 150px; height: 150px; margin: 0 auto 1.5rem;">
                            <svg viewBox="0 0 200 200" style="width: 100%; height: 100%;">
                                <circle cx="100" cy="100" r="90" fill="none" stroke="var(--border)" stroke-width="8" />
                                <circle cx="100" cy="100" r="90" fill="none" stroke="var(--gold)" stroke-width="8" stroke-dasharray="<?= ($fitScore / 100) * 565 ?> 565" stroke-linecap="round" style="transform: rotate(-90deg); transform-origin: 100px 100px;" />
                            </svg>
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                <div style="font-size: 2.5rem; font-weight: 700; color: var(--foreground);"><?= $fitScore ?></div>
                                <div style="font-size: 0.75rem; color: var(--muted-foreground); font-weight: 600;">OUT OF 100</div>
                            </div>
                        </div>
                        <p style="margin: 0; font-size: 1rem; font-weight: 600; color: var(--foreground);"><?= $suitability ?></p>
                    </div>

                    <!-- Breakdown & Advice -->
                    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                        <!-- Advice Card -->
                        <div style="padding: 1.5rem; background: var(--muted); border-radius: var(--radius); border: 1px solid var(--border);">
                            <h3 style="margin: 0 0 0.75rem; font-size: 0.875rem; color: var(--muted-foreground); font-weight: 600; text-transform: uppercase;">Recommendation</h3>
                            <p style="margin: 0; font-size: 1rem; color: var(--foreground); line-height: 1.6;"><?= $advice ?></p>
                        </div>

                        <!-- Score Breakdown with inline ternary logic -->
                        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">

                            <!-- Mode card -->
                            <div style="padding: 1rem; border: 1px solid var(--border); border-radius: var(--radius);">
                                <p style="margin: 0 0 0.5rem; font-size: 0.75rem; color: var(--muted-foreground); font-weight: 600; text-transform: uppercase;">Mode</p>
                                <p style="margin: 0; font-size: 0.95rem; font-weight: 600; color: var(--foreground);"><?= $modeLabel ?></p>
                                <div style="margin-top: 0.5rem; font-size: 0.8rem; color: var(--gold); font-weight: 500;">+<?= $modeScore ?> pts</div>
                                <div style="margin-top: 0.75rem; padding: 0.5rem 0.625rem; background: var(--foreground); border-radius: calc(var(--radius) - 2px); font-family: 'Courier New', monospace; font-size: 0.7rem; line-height: 1.6; color: #888;">
                                    <span>$modeScore =</span><br>
                                    &nbsp;&nbsp;<span style="color: #c792ea;">$workMode === 'remote'</span><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;? <span style="color: #7dd3a8; <?= $workMode === 'remote' ? 'font-weight: 700;' : 'opacity: 0.5;' ?>">24</span><br>
                                    &nbsp;&nbsp;: <span style="color: #c792ea;">$workMode === 'hybrid'</span><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;? <span style="color: #7dd3a8; <?= $workMode === 'hybrid' ? 'font-weight: 700;' : 'opacity: 0.5;' ?>">18</span> : <span style="color: #7dd3a8; <?= $workMode === 'onsite' ? 'font-weight: 700;' : 'opacity: 0.5;' ?>">12</span>;
                                </div>
                            </div>

                            <!-- Experience card -->
                            <div style="padding: 1rem; border: 1px solid var(--border); border-radius: var(--radius);">
                                <p style="margin: 0 0 0.5rem; font-size: 0.75rem; color: var(--muted-foreground); font-weight: 600; text-transform: uppercase;">Experience</p>
                                <p style="margin: 0; font-size: 0.95rem; font-weight: 600; color: var(--foreground);"><?= $experienceLabel ?></p>
                                <div style="margin-top: 0.5rem; font-size: 0.8rem; color: var(--gold); font-weight: 500;">+<?= $experienceScore ?> pts</div>
                                <div style="margin-top: 0.75rem; padding: 0.5rem 0.625rem; background: var(--foreground); border-radius: calc(var(--radius) - 2px); font-family: 'Courier New', monospace; font-size: 0.7rem; line-height: 1.6; color: #888;">
                                    <span>$experienceScore =</span><br>
                                    &nbsp;&nbsp;<span style="color: #c792ea;">$experience === 'senior'</span><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;? <span style="color: #7dd3a8; <?= $experience === 'senior' ? 'font-weight: 700;' : 'opacity: 0.5;' ?>">24</span><br>
                                    &nbsp;&nbsp;: <span style="color: #c792ea;">$experience === 'mid'</span><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;? <span style="color: #7dd3a8; <?= $experience === 'mid' ? 'font-weight: 700;' : 'opacity: 0.5;' ?>">18</span> : <span style="color: #7dd3a8; <?= $experience === 'junior' ? 'font-weight: 700;' : 'opacity: 0.5;' ?>">12</span>;
                                </div>
                            </div>

                            <!-- Salary card -->
                            <div style="padding: 1rem; border: 1px solid var(--border); border-radius: var(--radius);">
                                <p style="margin: 0 0 0.5rem; font-size: 0.75rem; color: var(--muted-foreground); font-weight: 600; text-transform: uppercase;">Salary</p>
                                <p style="margin: 0; font-size: 0.95rem; font-weight: 600; color: var(--foreground);">$<?= number_format($salary, 0) ?></p>
                                <div style="margin-top: 0.5rem; font-size: 0.8rem; color: var(--gold); font-weight: 500;">+<?= $baseScore ?> pts</div>
                                <div style="margin-top: 0.75rem; padding: 0.5rem 0.625rem; background: var(--foreground); border-radius: calc(var(--radius) - 2px); font-family: 'Courier New', monospace; font-size: 0.7rem; line-height: 1.6; color: #888;">
                                    <span>$baseScore =</span><br>
                                    &nbsp;&nbsp;<span style="color: #c792ea;">$salary >= 90000</span><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;? <span style="color: #7dd3a8; <?= $salary >= 90000 ? 'font-weight: 700;' : 'opacity: 0.5;' ?>">38</span><br>
                                    &nbsp;&nbsp;: <span style="color: #c792ea;">$salary >= 55000</span><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;? <span style="color: #7dd3a8; <?= ($salary >= 55000 && $salary < 90000) ? 'font-weight: 700;' : 'opacity: 0.5;' ?>">26</span> : <span style="color: #7dd3a8; <?= $salary < 55000 ? 'font-weight: 700;' : 'opacity: 0.5;' ?>">16</span>;
                                </div>
                            </div>

                            <!-- Portfolio card -->
                            <div style="padding: 1rem; border: 1px solid var(--border); border-radius: var(--radius);">
                                <p style="margin: 0 0 0.5rem; font-size: 0.75rem; color: var(--muted-foreground); font-weight: 600; text-transform: uppercase;">Portfolio</p>
                                <p style="margin: 0; font-size: 0.95rem; font-weight: 600; color: var(--foreground);"><?= $hasPortfolio ? 'Ready' : 'Missing' ?></p>
                                <div style="margin-top: 0.5rem; font-size: 0.8rem; color: var(--gold); font-weight: 500;">+<?= $portfolioScore ?> pts</div>
                                <div style="margin-top: 0.75rem; padding: 0.5rem 0.625rem; background: var(--foreground); border-radius: calc(var(--radius) - 2px); font-family: 'Courier New', monospace; font-size: 0.7rem; line-height: 1.6; color: #888;">
                                    <span>$portfolioScore =</span><br>
                                    &nbsp;&nbsp;<span style="color: #c792ea;">$hasPortfolio</span><br>
                                    &nbsp;&nbsp;&nbsp;&nbsp;? <span style="color: #7dd3a8; <?= $hasPortfolio ? 'font-weight: 700;' : 'opacity: 0.5;' ?>">14</span> : <span style="color: #7dd3a8; <?= !$hasPortfolio ? 'font-weight: 700;' : 'opacity: 0.5;' ?>">4</span>;
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 4rem 2rem; text-align: center; background: var(--muted); border-radius: var(--radius); border: 2px dashed var(--border);">
                    <i class="fa fa-search" style="font-size: 2.5rem; color: var(--muted-foreground); margin-bottom: 1rem;"></i>
                    <h3 style="margin: 0 0 0.5rem; font-size: 1.125rem; font-weight: 600; color: var(--foreground);">No results yet</h3>
                    <p style="margin: 0; color: var(--muted-foreground);">Fill in the form above to see your job seeker suitability score and personalized recommendations</p>
                </div>
            <?php endif; ?>
        </div>
</main>

<?= loadPartial("footer"); ?>