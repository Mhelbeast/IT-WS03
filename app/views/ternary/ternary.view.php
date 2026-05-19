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
        <div class="section-header" style="justify-content: center; border: 1px solid #d6dce8; padding: 2rem; border-radius: 0.625rem; margin-bottom: 2rem; text-align: center;">
            <div>
                <h1 class="section-title" style="font-size: 2.5rem; margin-bottom: 0.5rem;">Job Seeker Suitability</h1>
                <p class="section-subtitle">Evaluate how competitive your profile is for a given role</p>
            </div>
        </div>

        <!-- Form Card -->
        <div style="background: #fff; border: 1px solid #d6dce8; border-radius: 0.625rem; padding: 2rem; margin-bottom: 2rem;">
            <form method="GET" action="/ternary">
                <!-- Input Grid -->
                <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <!-- Asking Salary -->
                    <div>
                        <label for="salary" style="display: block; font-size: 0.75rem; font-weight: 600; color: #6b7280; margin-bottom: 0.5rem; text-transform: uppercase;">Asking Salary (USD)</label>
                        <input id="salary" name="salary" type="number" min="0" step="1000"
                            value="<?= htmlspecialchars($salaryInput) ?>"
                            placeholder="e.g. 65000"
                            class="input" />
                    </div>

                    <!-- Work Mode -->
                    <div>
                        <label for="mode" style="display: block; font-size: 0.75rem; font-weight: 600; color: #6b7280; margin-bottom: 0.5rem; text-transform: uppercase;">Work Mode</label>
                        <select id="mode" name="mode" class="input">
                            <option value="remote" <?= $workMode === 'remote'  ? 'selected' : '' ?>>Remote</option>
                            <option value="hybrid" <?= $workMode === 'hybrid'  ? 'selected' : '' ?>>Hybrid</option>
                            <option value="onsite" <?= $workMode === 'onsite'  ? 'selected' : '' ?>>On-site</option>
                        </select>
                    </div>

                    <!-- Experience Level -->
                    <div>
                        <label for="experience" style="display: block; font-size: 0.75rem; font-weight: 600; color: #6b7280; margin-bottom: 0.5rem; text-transform: uppercase;">Experience</label>
                        <select id="experience" name="experience" class="input">
                            <option value="junior" <?= $experience === 'junior' ? 'selected' : '' ?>>Junior</option>
                            <option value="mid" <?= $experience === 'mid' ? 'selected' : '' ?>>Mid-level</option>
                            <option value="senior" <?= $experience === 'senior' ? 'selected' : '' ?>>Senior</option>
                        </select>
                    </div>

                    <!-- Portfolio -->
                    <div>
                        <label for="portfolio" style="display: block; font-size: 0.75rem; font-weight: 600; color: #6b7280; margin-bottom: 0.5rem; text-transform: uppercase;">Portfolio</label>
                        <select id="portfolio" name="portfolio" class="input">
                            <option value="no" <?= !$hasPortfolio ? 'selected' : '' ?>>No portfolio</option>
                            <option value="yes" <?= $hasPortfolio ? 'selected' : '' ?>>Has portfolio</option>
                        </select>
                    </div>
                </div>

                <!-- Skills Checklist -->
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; font-size: 0.75rem; font-weight: 600; color: #6b7280; margin-bottom: 0.75rem; text-transform: uppercase;">Skills Match (check all that apply)</label>
                    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; padding: 1rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; background: #f9fafb;">
                        <?php foreach ($requiredSkills as $skill): ?>
                            <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                                <input type="checkbox" name="skills[]" value="<?= $skill ?>"
                                    <?= in_array($skill, $userSkills) ? 'checked' : '' ?>
                                    style="cursor: pointer;" />
                                <span style="font-size: 0.875rem; color: #374151;"><?= $skill ?></span>
                            </label>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn btn-primary" style="flex: 1;">
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
            '<div style="display: grid; grid-template-columns: 1fr 1.5fr; gap: 2rem;">
                <!-- Score Gauge Card -->
                <div style="background: #fff; border: 1px solid #d6dce8; border-radius: 0.625rem; padding: 2rem; text-align: center;">
                    <div style="position: relative; width: 160px; height: 160px; margin: 0 auto 1.5rem;">
                        <svg viewBox="0 0 200 200" style="width: 100%; height: 100%;">
                            <circle cx="100" cy="100" r="90" fill="none" stroke="#e5e7eb" stroke-width="8" />
                            <circle
                                cx="100" cy="100" r="90"
                                fill="none"
                                stroke="' . ($primaryPercent >= 100 ? '#22c55e' : ($primaryPercent >= 50 ? '#f59e0b' : '#ef4444')) . '"
                                stroke-width="8"
                                stroke-dasharray="' . round(($primaryPercent / 100) * 565, 2) . ' 565"
                                stroke-linecap="round"
                                style="transform: rotate(-90deg); transform-origin: 100px 100px;" />
                        </svg>
                        <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                            <div style="font-size: 2.25rem; font-weight: 700; color: #111827;">' . $primaryPercent . '%</div>
                            <div style="font-size: 0.75rem; font-weight: 600; color: #6b7280; text-transform: uppercase;">' . ($primaryCategory ? $primaryCategory : 'Skills') . '</div>
                        </div>
                    </div>
                    <p style="font-weight: 700; font-size: 1.125rem; margin: 1rem 0; color: ' . ($primaryPercent >= 100 ? '#22c55e' : ($primaryPercent >= 50 ? '#f59e0b' : '#ef4444')) . ';">' . ($primaryPercent >= 100 ? 'Highly Suitable' : ($primaryPercent >= 50 ? 'Strong Match' : 'Developing')) . '</p>
                </div>

                <!-- Advice Card -->
                <div style="background: #fff; border: 1px solid #d6dce8; border-radius: 0.625rem; padding: 2rem;">
                    <h3 style="font-size: 0.75rem; font-weight: 600; color: #6b7280; margin-bottom: 1rem; text-transform: uppercase;">
                        <i class="fa fa-lightbulb" aria-hidden="true"></i> Recommendation
                    </h3>
                    <p style="font-size: 1rem; color: #374151; line-height: 1.6;">' . $advice . '</p>
                </div>
            </div>'
            :
            '<div style="text-align: center; padding: 3rem; background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 0.625rem;">
                <i class="fa fa-info-circle" style="font-size: 2rem; color: #9ca3af; margin-bottom: 1rem;"></i>
                <p style="color: #6b7280; font-size: 1rem;">Select skills above to see your category suitability</p>
            </div>'
        ?>
    </div>
</main>

<?= loadPartial("footer"); ?>