<?php
use yii\helpers\Html;
use app\models\User;
use app\models\GameMatch;

$this->title = Yii::$app->params['appName'];
$isLoggedIn = !Yii::$app->user->isGuest;
$user = $isLoggedIn ? Yii::$app->user->identity : null;
$matchCount = GameMatch::find()->count();
?>

<style>
    .home-hero {
        text-align: center;
        padding: 60px 20px 40px;
        background: linear-gradient(135deg, rgba(0, 212, 255, 0.1) 0%, rgba(123, 47, 255, 0.1) 100%);
        border-radius: 16px;
        margin-bottom: 50px;
        animation: fadeInDown 0.6s ease-out;
    }

    [data-theme="light"] .home-hero {
        background: linear-gradient(135deg, rgba(0, 132, 255, 0.08) 0%, rgba(100, 150, 230, 0.08) 100%);
    }

    .hero-logo {
        font-size: 64px;
        margin-bottom: 20px;
    }

    .hero-title {
        font-size: 2.8rem;
        font-weight: 800;
        margin: 0 0 12px 0;
        color: #e8eaf0;
        letter-spacing: -1px;
    }

    [data-theme="light"] .hero-title {
        color: #1a1a1a;
    }

    .hero-subtitle {
        font-size: 1.1rem;
        color: rgba(232, 234, 240, 0.7);
        margin: 0;
        letter-spacing: 0.3px;
    }

    [data-theme="light"] .hero-subtitle {
        color: rgba(0, 0, 0, 0.6);
    }

    /* Countdown Section */
    .countdown-section {
        margin-bottom: 60px;
    }

    .countdown-title {
        text-align: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: #e8eaf0;
        margin-bottom: 30px;
        letter-spacing: 0.5px;
    }

    [data-theme="light"] .countdown-title {
        color: #1a1a1a;
    }

    #countdown_dashboard {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 16px;
        max-width: 600px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .countdown-item {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(0, 212, 255, 0.2);
        border-radius: 12px;
        padding: 24px 16px;
        text-align: center;
        transition: all 0.3s ease;
        animation: slideUp 0.6s ease-out;
    }

    .countdown-item:hover {
        border-color: rgba(0, 212, 255, 0.4);
        background: rgba(255, 255, 255, 0.08);
        transform: translateY(-4px);
    }

    [data-theme="light"] .countdown-item {
        background: rgba(0, 0, 0, 0.03);
        border-color: rgba(0, 132, 255, 0.2);
    }

    [data-theme="light"] .countdown-item:hover {
        border-color: rgba(0, 132, 255, 0.4);
        background: rgba(0, 0, 0, 0.05);
    }

    .countdown-digit {
        font-size: 2.5rem;
        font-weight: 800;
        color: #00d4ff;
        line-height: 1;
        margin-bottom: 8px;
        font-variant-numeric: tabular-nums;
    }

    [data-theme="light"] .countdown-digit {
        color: #0084ff;
    }

    .countdown-label {
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(232, 234, 240, 0.6);
    }

    [data-theme="light"] .countdown-label {
        color: rgba(0, 0, 0, 0.6);
    }

    /* Quick Actions Grid */
    .quick-actions {
        max-width: 1000px;
        margin: 0 auto 60px;
        padding: 0 20px;
    }

    .actions-title {
        text-align: center;
        font-size: 1.5rem;
        font-weight: 700;
        color: #e8eaf0;
        margin-bottom: 30px;
        letter-spacing: 0.5px;
    }

    [data-theme="light"] .actions-title {
        color: #1a1a1a;
    }

    .actions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
    }

    .action-card {
        background: rgba(255, 255, 255, 0.05);
        border: 2px solid rgba(0, 212, 255, 0.15);
        border-radius: 12px;
        padding: 32px 24px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        animation: slideUp 0.6s ease-out;
    }

    .action-card:hover {
        border-color: rgba(0, 212, 255, 0.35);
        background: rgba(255, 255, 255, 0.08);
        transform: translateY(-6px);
        box-shadow: 0 10px 30px rgba(0, 212, 255, 0.2);
    }

    [data-theme="light"] .action-card {
        background: rgba(0, 0, 0, 0.03);
        border-color: rgba(0, 132, 255, 0.15);
    }

    [data-theme="light"] .action-card:hover {
        border-color: rgba(0, 132, 255, 0.35);
        background: rgba(0, 0, 0, 0.05);
        box-shadow: 0 10px 30px rgba(0, 132, 255, 0.15);
    }

    .action-icon {
        font-size: 48px;
        opacity: 0.8;
        transition: transform 0.3s ease;
    }

    .action-card:hover .action-icon {
        transform: scale(1.1);
    }

    .action-label {
        font-size: 1.1rem;
        font-weight: 700;
        color: #e8eaf0;
    }

    [data-theme="light"] .action-label {
        color: #1a1a1a;
    }

    .action-count {
        font-size: 0.9rem;
        color: rgba(232, 234, 240, 0.6);
        margin-top: -8px;
    }

    [data-theme="light"] .action-count {
        color: rgba(0, 0, 0, 0.6);
    }

    /* User Stats Section */
    .user-stats-section {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .stats-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #e8eaf0;
        margin-bottom: 20px;
    }

    [data-theme="light"] .stats-title {
        color: #1a1a1a;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 16px;
        margin-top: 20px;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(0, 212, 255, 0.15);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
    }

    [data-theme="light"] .stat-card {
        background: rgba(0, 0, 0, 0.03);
        border-color: rgba(0, 132, 255, 0.15);
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: #00d4ff;
        line-height: 1;
        margin-bottom: 8px;
    }

    [data-theme="light"] .stat-value {
        color: #0084ff;
    }

    .stat-label {
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: rgba(232, 234, 240, 0.6);
    }

    [data-theme="light"] .stat-label {
        color: rgba(0, 0, 0, 0.6);
    }

    /* Animations */
    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @media (max-width: 768px) {
        .home-hero {
            padding: 40px 20px 30px;
            margin-bottom: 40px;
        }

        .hero-title {
            font-size: 2rem;
        }

        .hero-subtitle {
            font-size: 1rem;
        }

        #countdown_dashboard {
            grid-template-columns: repeat(2, 1fr);
        }

        .actions-grid {
            grid-template-columns: 1fr;
        }

        .countdown-digit {
            font-size: 2rem;
        }
    }
</style>

<!-- Hero Section -->
<div class="home-hero">
    <div class="hero-logo">⚽</div>
    <h1 class="hero-title">World Cup 2026</h1>
    <p class="hero-subtitle">Predict the future. Make your voice heard.</p>
</div>

<!-- Countdown Section -->
<div class="countdown-section">
    <h2 class="countdown-title">Time Until Kickoff</h2>
    <div id="countdown_dashboard">
        <div class="countdown-item">
            <div class="countdown-digit days-digit">0</div>
            <div class="countdown-label">Days</div>
        </div>
        <div class="countdown-item">
            <div class="countdown-digit hours-digit">0</div>
            <div class="countdown-label">Hours</div>
        </div>
        <div class="countdown-item">
            <div class="countdown-digit minutes-digit">0</div>
            <div class="countdown-label">Minutes</div>
        </div>
        <div class="countdown-item">
            <div class="countdown-digit seconds-digit">0</div>
            <div class="countdown-label">Seconds</div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="quick-actions">
    <h2 class="actions-title">Get Started</h2>
    <div class="actions-grid">
        <a href="/team/index" class="action-card">
            <div class="action-icon">🏆</div>
            <div class="action-label">Tour</div>
            <div class="action-count">48 Teams</div>
        </a>
        <a href="/match/index" class="action-card">
            <div class="action-icon">⚽</div>
            <div class="action-label">Matches</div>
            <div class="action-count"><?= $matchCount ?> Matches</div>
        </a>
        <a href="/ranking/index" class="action-card">
            <div class="action-icon">📊</div>
            <div class="action-label">Rankings</div>
            <div class="action-count">Top Predictors</div>
        </a>
        <?php if ($isLoggedIn): ?>
            <a href="/bet/index" class="action-card">
                <div class="action-icon">🎯</div>
                <div class="action-label">Predictions</div>
                <div class="action-count">Make Your Picks</div>
            </a>
        <?php else: ?>
            <a href="/user/login" class="action-card">
                <div class="action-icon">🔐</div>
                <div class="action-label">Sign In</div>
                <div class="action-count">Start Predicting</div>
            </a>
        <?php endif; ?>
    </div>
</div>

<?php if ($isLoggedIn && $user): ?>
<!-- User Stats Section -->
<div class="user-stats-section" style="margin-top: 60px;">
    <h2 class="stats-title">Your Performance</h2>
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-value"><?= isset($user->profile->points) ? $user->profile->points : 0 ?></div>
            <div class="stat-label">Points</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">-</div>
            <div class="stat-label">Rank</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">-</div>
            <div class="stat-label">Predictions</div>
        </div>
        <div class="stat-card">
            <div class="stat-value">-</div>
            <div class="stat-label">Accuracy</div>
        </div>
    </div>
</div>
<?php endif; ?>

<script>
(function() {
    function updateCountdown() {
        const countdownDate = new Date('2026-06-12T00:00:00').getTime();
        const now = new Date().getTime();
        const distance = countdownDate - now;

        if (distance < 0) {
            document.querySelector('.days-digit').innerHTML = '0';
            document.querySelector('.hours-digit').innerHTML = '0';
            document.querySelector('.minutes-digit').innerHTML = '0';
            document.querySelector('.seconds-digit').innerHTML = '0';
            return;
        }

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.querySelector('.days-digit').innerHTML = days.toString().padStart(2, '0');
        document.querySelector('.hours-digit').innerHTML = hours.toString().padStart(2, '0');
        document.querySelector('.minutes-digit').innerHTML = minutes.toString().padStart(2, '0');
        document.querySelector('.seconds-digit').innerHTML = seconds.toString().padStart(2, '0');
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
})();
</script>
