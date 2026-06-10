<?php
use yii\helpers\Html;
use app\models\User;
use app\models\GameMatch;
use app\models\Team;

$this->title = Yii::$app->params['appName'];
$isLoggedIn = !Yii::$app->user->isGuest;
$user = $isLoggedIn ? Yii::$app->user->identity : null;
$matchCount = GameMatch::find()->count();
$teamCount = Team::find()->count();
?>

<style>
    /* Main Container */
    .home-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Header Stats */
    .stats-header {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin: 50px 0;
        background: rgba(0, 0, 0, 0.9);
        padding: 40px 20px;
        border-radius: 8px;
    }

    [data-theme="light"] .stats-header {
        background: rgba(255, 255, 255, 0.95);
    }

    .stat-item {
        text-align: center;
    }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #00d4ff;
        line-height: 1;
        margin-bottom: 8px;
    }

    [data-theme="light"] .stat-number {
        color: #0084ff;
    }

    .stat-label {
        font-size: 0.95rem;
        color: rgba(232, 234, 240, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    [data-theme="light"] .stat-label {
        color: rgba(0, 0, 0, 0.7);
    }

    /* Title */
    .page-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #ffffff;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
        margin: 40px 0 20px;
    }

    [data-theme="light"] .page-title {
        color: #1a1a1a;
        text-shadow: none;
    }

    /* Countdown Section */
    .countdown-section {
        background: rgba(0, 0, 0, 0.9);
        padding: 40px 20px;
        border-radius: 8px;
        margin-bottom: 60px;
    }

    [data-theme="light"] .countdown-section {
        background: rgba(255, 255, 255, 0.95);
    }

    .countdown-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 20px;
    }

    .countdown-item {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(0, 212, 255, 0.3);
        border-radius: 8px;
        padding: 30px 20px;
        text-align: center;
    }

    [data-theme="light"] .countdown-item {
        background: rgba(0, 0, 0, 0.03);
        border-color: rgba(0, 132, 255, 0.25);
    }

    .countdown-value {
        font-size: 2.8rem;
        font-weight: 800;
        color: #00d4ff;
        line-height: 1;
        margin-bottom: 8px;
        font-variant-numeric: tabular-nums;
    }

    [data-theme="light"] .countdown-value {
        color: #0084ff;
    }

    .countdown-unit {
        font-size: 0.85rem;
        color: rgba(232, 234, 240, 0.8);
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 600;
    }

    [data-theme="light"] .countdown-unit {
        color: rgba(0, 0, 0, 0.7);
    }

    /* Navigation Tabs */
    .nav-tabs-section {
        margin: 40px 0;
    }

    .nav-tabs {
        display: flex;
        gap: 10px;
        border-bottom: 2px solid rgba(0, 212, 255, 0.2);
        overflow-x: auto;
        padding-bottom: 15px;
    }

    [data-theme="light"] .nav-tabs {
        border-bottom-color: rgba(0, 132, 255, 0.2);
    }

    .nav-tab {
        padding: 10px 20px;
        background: transparent;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        font-weight: 600;
        color: rgba(232, 234, 240, 0.6);
        text-decoration: none;
        white-space: nowrap;
        border-bottom: 3px solid transparent;
        transition: all 0.2s ease;
    }

    .nav-tab:hover {
        color: #00d4ff;
    }

    .nav-tab.active {
        color: #00d4ff;
        border-bottom-color: #00d4ff;
    }

    [data-theme="light"] .nav-tab {
        color: rgba(0, 0, 0, 0.6);
    }

    [data-theme="light"] .nav-tab:hover,
    [data-theme="light"] .nav-tab.active {
        color: #0084ff;
        border-bottom-color: #0084ff;
    }

    /* Content Sections */
    .content-section {
        background: rgba(0, 0, 0, 0.9);
        padding: 30px 20px;
        border-radius: 8px;
        margin-bottom: 40px;
    }

    [data-theme="light"] .content-section {
        background: rgba(255, 255, 255, 0.95);
    }

    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 20px;
    }

    [data-theme="light"] .section-title {
        color: #1a1a1a;
    }

    .action-links {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
    }

    .action-link {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(0, 212, 255, 0.25);
        border-radius: 8px;
        padding: 24px;
        text-align: left;
        text-decoration: none;
        color: inherit;
        transition: all 0.2s ease;
        cursor: pointer;
    }

    .action-link:hover {
        background: rgba(255, 255, 255, 0.12);
        border-color: rgba(0, 212, 255, 0.4);
    }

    [data-theme="light"] .action-link {
        background: rgba(0, 0, 0, 0.03);
        border-color: rgba(0, 132, 255, 0.2);
    }

    [data-theme="light"] .action-link:hover {
        background: rgba(0, 0, 0, 0.06);
        border-color: rgba(0, 132, 255, 0.35);
    }

    .link-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 8px;
    }

    [data-theme="light"] .link-title {
        color: #1a1a1a;
    }

    .link-desc {
        font-size: 0.9rem;
        color: rgba(232, 234, 240, 0.7);
    }

    [data-theme="light"] .link-desc {
        color: rgba(0, 0, 0, 0.6);
    }

    /* Tournament Info Section */
    .trophy-section {
        background: rgba(0, 0, 0, 0.9);
        padding: 30px 20px;
        border-radius: 8px;
        margin: 60px 0;
    }

    [data-theme="light"] .trophy-section {
        background: rgba(255, 255, 255, 0.95);
    }

    .trophy-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: stretch;
    }

    .trophy-info {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .trophy-title {
        font-size: 1.8rem;
        font-weight: 700;
        color: #ffffff;
    }

    [data-theme="light"] .trophy-title {
        color: #1a1a1a;
    }

    .trophy-desc {
        font-size: 1rem;
        color: rgba(232, 234, 240, 0.8);
        line-height: 1.6;
    }

    [data-theme="light"] .trophy-desc {
        color: rgba(0, 0, 0, 0.7);
    }

    /* 3D Trophy Panel */
    .trophy-panel {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .trophy-scene {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(0, 212, 255, 0.2);
        border-radius: 8px;
        overflow: hidden;
        min-height: 400px;
        flex: 1;
    }

    [data-theme="light"] .trophy-scene {
        background: rgba(0, 0, 0, 0.02);
        border-color: rgba(0, 132, 255, 0.2);
    }

    .trophy-scene canvas {
        width: 100% !important;
        height: 100% !important;
        display: block !important;
    }

    .trophy-controls {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
        padding: 15px;
        background: rgba(255, 255, 255, 0.08);
        border-radius: 6px;
    }

    [data-theme="light"] .trophy-controls {
        background: rgba(0, 0, 0, 0.04);
    }

    .trophy-controls button {
        padding: 8px 16px;
        background: rgba(0, 212, 255, 0.2);
        border: 1px solid rgba(0, 212, 255, 0.4);
        border-radius: 4px;
        color: #00d4ff;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
        font-size: 0.85rem;
        white-space: nowrap;
    }

    .trophy-controls button:hover {
        background: rgba(0, 212, 255, 0.3);
        border-color: rgba(0, 212, 255, 0.6);
    }

    [data-theme="light"] .trophy-controls button {
        background: rgba(0, 132, 255, 0.15);
        border-color: rgba(0, 132, 255, 0.35);
        color: #0084ff;
    }

    [data-theme="light"] .trophy-controls button:hover {
        background: rgba(0, 132, 255, 0.25);
        border-color: rgba(0, 132, 255, 0.5);
    }

    .trophy-controls label {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(232, 234, 240, 0.8);
        font-size: 0.85rem;
        white-space: nowrap;
    }

    [data-theme="light"] .trophy-controls label {
        color: rgba(0, 0, 0, 0.7);
    }

    .trophy-controls input[type="range"] {
        width: 100px;
        cursor: pointer;
    }

    @media (max-width: 1024px) {
        .trophy-container {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .countdown-grid {
            grid-template-columns: repeat(2, 1fr);
        }

        .action-links {
            grid-template-columns: 1fr;
        }

        .nav-tabs {
            flex-wrap: wrap;
        }

        .trophy-controls {
            flex-direction: column;
            align-items: stretch;
        }

        .trophy-controls label {
            flex-direction: column;
        }
    }
</style>

<div class="home-container">
    <!-- Key Statistics Header -->
    <div class="stats-header">
        <div class="stat-item">
            <div class="stat-number"><?= $teamCount ?></div>
            <div class="stat-label">Teams</div>
        </div>
        <div class="stat-item">
            <div class="stat-number"><?= $matchCount ?></div>
            <div class="stat-label">Matches</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">12</div>
            <div class="stat-label">Groups</div>
        </div>
        <div class="stat-item">
            <div class="stat-number">6</div>
            <div class="stat-label">Knockout Rounds</div>
        </div>
    </div>

    <!-- Countdown Timer -->
    <h2 class="page-title">Time Until Kickoff</h2>
    <div class="countdown-section">
        <div class="countdown-grid">
            <div class="countdown-item">
                <div class="countdown-value days-digit">0</div>
                <div class="countdown-unit">Days</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value hours-digit">0</div>
                <div class="countdown-unit">Hours</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value minutes-digit">0</div>
                <div class="countdown-unit">Minutes</div>
            </div>
            <div class="countdown-item">
                <div class="countdown-value seconds-digit">0</div>
                <div class="countdown-unit">Seconds</div>
            </div>
        </div>
    </div>

    <!-- Tournament Info Section with 3D Trophy -->
    <div class="trophy-section">
        <h2 class="section-title">Tournament Information</h2>
        <div class="trophy-container">
            <div class="trophy-info">
                <h3 class="trophy-title">World Cup 2026</h3>
                <p class="trophy-desc">
                    The World Cup is the most prestigious international football competition.
                    Held every four years, it brings together the world's greatest teams to compete
                    for the legendary gold trophy.
                </p>
                <p class="trophy-desc">
                    The 2026 tournament will be historic as the first to feature 48 teams across
                    three host nations: USA, Canada, and Mexico. Experience 104 matches of world-class
                    football as teams battle from group stage through knockout rounds to claim glory.
                </p>
            </div>
            <div class="trophy-panel" aria-label="World Cup Trophy 3D Model">
                <div class="sketchfab-embed-wrapper" style="border-radius: 12px; overflow: hidden;">
                    <iframe title="World Cup Trophy" frameborder="0" allowfullscreen mozallowfullscreen="true" webkitallowfullscreen="true" allow="autoplay; fullscreen; xr-spatial-tracking" xr-spatial-tracking execution-while-out-of-viewport execution-while-not-rendered web-share src="https://sketchfab.com/models/76fe488adc344a4bbd2e18698f551bd6/embed?autospin=1&autostart=1&preload=1&transparent=1&ui_theme=dark&dnt=1" style="width: 100%; height: 450px; border: none;"></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="content-section">
        <h2 class="section-title">Get Started</h2>
        <div class="action-links">
            <a href="/team/index" class="action-link">
                <div class="link-title">Browse Teams</div>
                <div class="link-desc">View all 48 teams in group stage and knockout rounds</div>
            </a>
            <a href="/match/index" class="action-link">
                <div class="link-title">Match Schedule</div>
                <div class="link-desc">See upcoming matches and tournament schedule</div>
            </a>
            <a href="/ranking/index" class="action-link">
                <div class="link-title">View Rankings</div>
                <div class="link-desc">Check top predictors and leaderboard</div>
            </a>
        </div>
    </div>

    <?php if ($isLoggedIn && $user): ?>
    <!-- User Stats Section -->
    <div class="content-section">
        <h2 class="section-title">Your Stats</h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 20px;">
            <div style="text-align: center;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #00d4ff; margin-bottom: 8px;">
                    <?= isset($user->profile->points) ? $user->profile->points : 0 ?>
                </div>
                <div style="font-size: 0.9rem; color: rgba(232, 234, 240, 0.7); text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Points</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #00d4ff; margin-bottom: 8px;">-</div>
                <div style="font-size: 0.9rem; color: rgba(232, 234, 240, 0.7); text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Rank</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #00d4ff; margin-bottom: 8px;">-</div>
                <div style="font-size: 0.9rem; color: rgba(232, 234, 240, 0.7); text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Predictions</div>
            </div>
            <div style="text-align: center;">
                <div style="font-size: 2.2rem; font-weight: 800; color: #00d4ff; margin-bottom: 8px;">-</div>
                <div style="font-size: 0.9rem; color: rgba(232, 234, 240, 0.7); text-transform: uppercase; letter-spacing: 1px; font-weight: 600;">Accuracy</div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<script>
(function() {
    let countdownFinished = false;

    function updateCountdown() {
        const countdownDate = new Date('2026-06-12T00:00:00').getTime();
        const now = new Date().getTime();
        const distance = countdownDate - now;

        if (distance < 0) {
            if (!countdownFinished) {
                countdownFinished = true;
                const countdownSection = document.querySelector('.countdown-section');
                const countdownGrid = document.querySelector('.countdown-grid');

                if (countdownSection && countdownGrid) {
                    countdownGrid.innerHTML = '<div style="text-align: center; padding: 40px 20px; grid-column: 1 / -1;"><h2 style="font-size: 2rem; font-weight: 800; color: #00d4ff; margin: 0 0 15px 0;">The World Cup 2026 is Here! 🎉</h2><p style="font-size: 1.1rem; color: rgba(232, 234, 240, 0.8); margin: 0;">Join the excitement and make your predictions!</p></div>';
                }
            }
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        const daysDigit = document.querySelector('.days-digit');
        const hoursDigit = document.querySelector('.hours-digit');
        const minutesDigit = document.querySelector('.minutes-digit');
        const secondsDigit = document.querySelector('.seconds-digit');

        if (daysDigit) daysDigit.innerHTML = days.toString().padStart(2, '0');
        if (hoursDigit) hoursDigit.innerHTML = hours.toString().padStart(2, '0');
        if (minutesDigit) minutesDigit.innerHTML = minutes.toString().padStart(2, '0');
        if (secondsDigit) secondsDigit.innerHTML = seconds.toString().padStart(2, '0');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
})();
</script>
