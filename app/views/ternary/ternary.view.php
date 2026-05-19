<?= loadPartial("head"); ?>

<!-- Nav -->
<?= loadPartial("navbar"); ?>

<?php
// --- Input Sanitization ---
$salaryInput    = isset($_GET['salary']) ? trim((string) $_GET['salary']) : '';
$workMode       = $_GET['mode']       ?? 'remote';
$experience     = $_GET['experience'] ?? 'junior';
$portfolioInput = $_GET['portfolio']  ?? '';
$userSkills     = $_GET['skills'] ?? []; // array from checklist

$workMode   = in_array($workMode,   ['remote', 'hybrid', 'onsite'],           true) ? $workMode   : 'remote';
$experience = in_array($experience, ['junior', 'mid', 'senior'],              true) ? $experience : 'junior';
$hasPortfolio = $portfolioInput === 'yes';

$salary = is_numeric($salaryInput) ? (float) $salaryInput : null;

// --- Role Required Skills (Static Checklist) ---
$requiredSkills = [
    'PHP',
    'JavaScript',
    'React',
    'Node.js',
    'Python',
    'HTML/CSS',
    'Git',
    'Docker',
    'SQL',
    'Problem Solving',
    'Figma',
    'Framer'
];

// --- Scoring ---
$salaryScore = $salary !== null
    ? ($salary < 55000 ? 30 : ($salary < 90000 ? 20 : 10))
    : 0;

$modeScore = $workMode === 'onsite'  ? 20
    : ($workMode === 'hybrid' ? 15 : 10);

$experienceScore = $experience === 'senior' ? 25
    : ($experience === 'mid'   ? 18 : 10);

$portfolioScore = $hasPortfolio ? 15 : 4;

// --- Skill Categories ---
$designSkills = ['Figma', 'Framer'];
$frontendSkills = ['JavaScript', 'React', 'HTML/CSS'];
$backendSkills = ['PHP', 'Node.js', 'Python', 'Docker', 'SQL'];
$devToolsSkills = ['Git', 'Problem Solving'];

// --- Category Skill Match Calculation ---
if (!is_array($userSkills)) $userSkills = [];

$designMatch = array_intersect($userSkills, $designSkills);
$designPercent = count($designSkills) > 0 ? min(100, round((count($designMatch) / count($designSkills)) * 100) + ($hasPortfolio ? 15 : 0)) : 0;

$frontendMatch = array_intersect($userSkills, $frontendSkills);
$frontendPercent = count($frontendSkills) > 0 ? min(100, round((count($frontendMatch) / count($frontendSkills)) * 100) + ($hasPortfolio ? 15 : 0)) : 0;

$backendMatch = array_intersect($userSkills, $backendSkills);
$backendPercent = count($backendSkills) > 0 ? min(100, round((count($backendMatch) / count($backendSkills)) * 100) + ($hasPortfolio ? 15 : 0)) : 0;

$devToolsMatch = array_intersect($userSkills, $devToolsSkills);
$devToolsPercent = count($devToolsSkills) > 0 ? min(100, round((count($devToolsMatch) / count($devToolsSkills)) * 100) + ($hasPortfolio ? 15 : 0)) : 0;

// --- Determine Primary Skill Category ---
$categoryScores = [
    'Design' => $designPercent,
    'Frontend' => $frontendPercent,
    'Backend' => $backendPercent,
    'DevTools' => $devToolsPercent
];

$primaryCategory = array_key_first(array_filter($categoryScores, fn($v) => $v > 0));
$primaryPercent = $primaryCategory ? $categoryScores[$primaryCategory] : 0;

// --- Overall Fit Score ---
$allSkillsSelected = count($userSkills);
$matchedSkills = array_intersect($userSkills, $requiredSkills);
$skillsScore = count($requiredSkills) > 0 ? round((count($matchedSkills) / count($requiredSkills)) * 10) : 0;

$fitScore = min(100, $salaryScore + $modeScore + $experienceScore + $portfolioScore + $skillsScore);

// --- Suitability Verdict ---
$suitability = $salary !== null
    ? ($fitScore >= 75 ? 'Highly Suitable'
        : ($fitScore >= 50 ? 'Moderately Suitable' : 'Low Suitability'))
    : null;

$isHighSuitability = $fitScore >= 75;
$isMidSuitability  = $fitScore >= 50 && $fitScore < 75;
$isLowSuitability  = $fitScore < 50;
$gaugeColor = $isHighSuitability ? '#22c55e' : ($isMidSuitability ? '#f59e0b' : '#ef4444');

// --- Dynamic Advice based on Skill Category ---
if ($salary !== null && $allSkillsSelected > 0) {
    if ($primaryCategory === 'Design') {
        $advice = $designPercent >= 100
            ? 'Highly Suitable for Design! You have all design tools and strong portfolio support. You are highly competitive for UI/UX and product design roles. Showcase your best design work and apply with confidence!'
            : ($designPercent >= 50
                ? 'Strong Design Foundation! You have key design skills. Add one more design tool and build portfolio projects to strengthen your profile.'
                : 'Design skills detected. Add Figma or Framer and build design projects to improve your suitability.');
    } elseif ($primaryCategory === 'Frontend') {
        $advice = $frontendPercent >= 100
            ? 'Highly Suitable for Frontend Development! You have all frontend essentials and portfolio support. You are highly competitive for frontend engineer roles. Showcase your projects and apply immediately!'
            : ($frontendPercent >= 67
                ? 'Strong Frontend Skills! You have solid frontend fundamentals. Add one more skill (JavaScript, React, or HTML/CSS) and build practice projects to strengthen your profile.'
                : 'Frontend fundamentals developing. Build more hands-on projects with React and JavaScript to increase your suitability.');
    } elseif ($primaryCategory === 'Backend') {
        $advice = $backendPercent >= 100
            ? 'Highly Suitable for Backend Development! You have comprehensive backend skills and portfolio support. You are highly competitive for backend and full-stack roles. Highlight your architecture and best projects!'
            : ($backendPercent >= 60
                ? 'Strong Backend Foundation! You have solid backend knowledge. Add more database or containerization skills and build real-world backend projects.'
                : 'Backend skills emerging. Strengthen your knowledge in databases (SQL) and server frameworks with practical projects.');
    } elseif ($primaryCategory === 'DevTools') {
        $advice = 'You have development tools and soft skills. Combine with frontend or backend technologies to create a well-rounded developer profile with demonstrable projects.';
    } else {
        $advice = ($fitScore >= 75
            ? 'You are a strong candidate. Apply with confidence and highlight your most relevant achievements.'
            : ($fitScore >= 50
                ? 'You have potential but could improve your standing. Build more skills, gain more experience, or align your salary expectations closer to market rate.'
                : 'Your profile needs more development. Focus on upskilling and creating a strong portfolio with real projects.'));
    }
} else {
    $advice = null;
}
?>

<main class="page-section">
    <div class="site-container">
        <div class="section-header ternary-section-header">
            <div>
                <h1 class="section-title ternary-section-title">Job Seeker Suitability</h1>
                <p class="section-subtitle">Evaluate how competitive your profile is for a given role</p>
            </div>
        </div>

        <!-- Form Card -->
        <div class="ternary-form-card">
            <form method="GET" action="/ternary">
                <!-- Input Grid -->
                <div class="ternary-input-grid">
                    <!-- Asking Salary -->
                    <div>
                        <label for="salary" class="ternary-label">Asking Salary (USD)</label>
                        <input id="salary" name="salary" type="number" min="0" step="1000"
                            value="<?= htmlspecialchars($salaryInput) ?>"
                            placeholder="e.g. 65000"
                            class="input" />
                    </div>

                    <!-- Work Mode -->
                    <div>
                        <label for="mode" class="ternary-label">Work Mode</label>
                        <select id="mode" name="mode" class="input">
                            <option value="remote" <?= $workMode === 'remote'  ? 'selected' : '' ?>>Remote</option>
                            <option value="hybrid" <?= $workMode === 'hybrid'  ? 'selected' : '' ?>>Hybrid</option>
                            <option value="onsite" <?= $workMode === 'onsite'  ? 'selected' : '' ?>>On-site</option>
                        </select>
                    </div>

                    <!-- Experience Level -->
                    <div>
                        <label for="experience" class="ternary-label">Experience</label>
                        <select id="experience" name="experience" class="input">
                            <option value="junior" <?= $experience === 'junior' ? 'selected' : '' ?>>Junior</option>
                            <option value="mid" <?= $experience === 'mid' ? 'selected' : '' ?>>Mid-level</option>
                            <option value="senior" <?= $experience === 'senior' ? 'selected' : '' ?>>Senior</option>
                        </select>
                    </div>

                    <!-- Portfolio -->
                    <div>
                        <label for="portfolio" class="ternary-label">Portfolio</label>
                        <select id="portfolio" name="portfolio" class="input">
                            <option value="no" <?= !$hasPortfolio ? 'selected' : '' ?>>No portfolio</option>
                            <option value="yes" <?= $hasPortfolio ? 'selected' : '' ?>>Has portfolio</option>
                        </select>
                    </div>
                </div>

                <!-- Skills Checklist -->
                <div class="ternary-skills-container">
                    <label class="ternary-label">Skills Match (check all that apply)</label>
                    <div class="ternary-skills-grid">
                        <?php foreach ($requiredSkills as $skill): ?>
                            <label class="ternary-skill-label">
                                <input type="checkbox" name="skills[]" value="<?= $skill ?>"
                                    <?= in_array($skill, $userSkills) ? 'checked' : '' ?>
                                    class="ternary-skill-input" />
                                <span class="ternary-skill-text"><?= $skill ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="ternary-button-group">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check" aria-hidden="true"></i> Analyze Profile
                    </button>
                    <a href="/ternary" class="btn btn-secondary">
                        <i class="fa fa-redo" aria-hidden="true"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Results Section -->
        <?= $salary !== null && $allSkillsSelected > 0 ?
            '<div class="ternary-results-grid">
                <!-- Score Gauge Card -->
                <div class="ternary-gauge-card">
                    <div class="ternary-gauge-container">
                        <svg viewBox="0 0 200 200" class="ternary-gauge-svg">
                            <circle cx="100" cy="100" r="90" fill="none" stroke="#e5e7eb" stroke-width="8" />
                            <circle
                                cx="100" cy="100" r="90"
                                fill="none"
                                stroke="' . ($primaryPercent >= 100 ? '#22c55e' : ($primaryPercent >= 50 ? '#f59e0b' : '#ef4444')) . '"
                                stroke-width="8"
                                stroke-dasharray="' . round(($primaryPercent / 100) * 565, 2) . ' 565"
                                stroke-linecap="round"
                                class="ternary-gauge-circle" />
                        </svg>
                        <div class="ternary-gauge-text">
                            <div class="ternary-gauge-percent">' . $primaryPercent . '%</div>
                            <div class="ternary-gauge-label">' . ($primaryCategory ? $primaryCategory : 'Skills') . '</div>
                        </div>
                    </div>
                    <p class="ternary-gauge-status ' . ($primaryPercent >= 100 ? 'highly-suitable' : ($primaryPercent >= 50 ? 'strong-match' : 'developing')) . '">' . ($primaryPercent >= 100 ? 'Highly Suitable' : ($primaryPercent >= 50 ? 'Strong Match' : 'Developing')) . '</p>
                </div>

                <!-- Advice Card -->
                <div class="ternary-advice-card">
                    <h3 class="ternary-advice-title">
                        <i class="fa fa-lightbulb" aria-hidden="true"></i> Recommendation
                    </h3>
                    <p class="ternary-advice-text">' . $advice . '</p>
                </div>
            </div>'
            :
            '<div class="ternary-empty-state">
                <i class="fa fa-info-circle ternary-empty-icon"></i>
                <p class="ternary-empty-text">Select skills above to see your category suitability</p>
            </div>'
        ?>
    </div>
</main>

<?= loadPartial("footer"); ?>