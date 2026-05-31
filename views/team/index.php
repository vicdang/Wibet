<?php
use yii\helpers\Html;
use app\models\AdminConfig;

$this->title = 'Tour';
$groups = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];

// Calculate total teams and get season name
$totalTeams = 0;
foreach ($groupedTeams as $groupTeams) {
    $totalTeams += count($groupTeams);
}
$seasonName = AdminConfig::get('season_name') ?: Yii::$app->params['seasonName'];
?>

<style>
/* Tour Page - Bracket View Only */
.tour-index {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .tour-index {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
}

.tour-wrapper {
    max-width: 1400px;
    margin: 0 auto;
}

/* Hero Section */
.tour-hero {
    text-align: center;
    margin-bottom: 50px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
}

.tour-hero h1 {
    font-size: 3rem;
    font-weight: 800;
    margin: 0 0 16px 0;
    letter-spacing: -1px;
}

[data-theme="light"] .tour-hero h1 {
    color: #1a1a1a;
}

.tour-hero p {
    font-size: 1.1rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    margin: 0;
}

/* Bracket Grid */
.bracket-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 30px;
    margin-top: 40px;
}

.bracket-group {
    background: var(--card-bg, rgba(255, 255, 255, 0.05));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    padding: 24px;
    transition: all 0.3s ease;
}

.bracket-group:hover {
    border-color: rgba(0, 212, 255, 0.4);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .bracket-group {
    background: #ffffff;
    border-color: rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .bracket-group:hover {
    border-color: rgba(31, 115, 230, 0.3);
    box-shadow: 0 8px 24px rgba(31, 115, 230, 0.08);
}

.bracket-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin: 0 0 20px 0;
    padding-bottom: 12px;
    border-bottom: 2px solid rgba(0, 212, 255, 0.3);
    letter-spacing: 0.5px;
}

[data-theme="light"] .bracket-title {
    border-bottom-color: rgba(31, 115, 230, 0.2);
}

.bracket-teams {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.bracket-team-link {
    text-decoration: none;
    color: inherit;
}

.bracket-team {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.02);
    transition: all 0.2s ease;
}

.bracket-team:hover {
    background: rgba(0, 212, 255, 0.1);
    transform: translateX(4px);
}

[data-theme="light"] .bracket-team:hover {
    background: rgba(31, 115, 230, 0.08);
}

.bracket-flag-wrapper {
    width: 56px;
    height: 56px;
    flex-shrink: 0;
    border-radius: 8px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bracket-flag {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.bracket-flag-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.2) 0%, rgba(123, 47, 255, 0.2) 100%);
}

.bracket-team-info {
    flex: 1;
    min-width: 0;
}

.bracket-team-name {
    font-weight: 700;
    font-size: 0.95rem;
    margin: 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    letter-spacing: 0.3px;
}

.bracket-team-full {
    font-size: 0.8rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.6));
    margin: 4px 0 0 0;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

[data-theme="light"] .bracket-team-full {
    color: rgba(0, 0, 0, 0.65);
}

.bracket-team-stats {
    flex-shrink: 0;
    margin-left: 8px;
}

.stat-badge {
    display: inline-block;
    padding: 4px 10px;
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.2) 0%, rgba(123, 47, 255, 0.2) 100%);
    border: 1px solid rgba(0, 212, 255, 0.3);
    border-radius: 6px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.3px;
    white-space: nowrap;
}

[data-theme="light"] .stat-badge {
    background: linear-gradient(135deg, rgba(31, 115, 230, 0.15) 0%, rgba(66, 133, 244, 0.15) 100%);
    border-color: rgba(31, 115, 230, 0.3);
}

/* Responsive */
@media (max-width: 768px) {
    .tour-hero h1 {
        font-size: 2rem;
    }

    .bracket-container {
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
    }

    .bracket-team {
        padding: 10px;
    }

    .bracket-flag-wrapper {
        width: 48px;
        height: 48px;
    }
}
</style>

<div class="tour-index">
    <div class="tour-wrapper">
        <!-- Hero Section -->
        <div class="tour-hero">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>All <?= $totalTeams ?> teams competing in the <?= Html::encode($seasonName) ?></p>
        </div>

        <!-- Bracket View -->
        <div class="bracket-container">
            <?php foreach ($groups as $group): ?>
                <div class="bracket-group">
                    <h4 class="bracket-title">Group <?= $group ?></h4>
                    <div class="bracket-teams">
                        <?php
                        $groupTeams = $groupedTeams[$group] ?? [];
                        foreach ($groupTeams as $team):
                        ?>
                            <a href="/team/view?id=<?= $team->id ?>" class="bracket-team-link">
                                <div class="bracket-team">
                                    <div class="bracket-flag-wrapper">
                                        <?php $flagUrl = $team->getFlagUrl(); ?>
                                        <?php if ($flagUrl): ?>
                                            <img src="<?= Html::encode($flagUrl) ?>" alt="<?= Html::encode($team->name) ?>" class="bracket-flag">
                                        <?php elseif ($team->isPlayoffTeam()): ?>
                                            <img src="/logo.png" alt="<?= Html::encode($team->name) ?>" class="bracket-flag playoff-logo">
                                        <?php else: ?>
                                            <div class="bracket-flag-placeholder"></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="bracket-team-info">
                                        <div class="bracket-team-name"><?= Html::encode($team->name) ?></div>
                                        <div class="bracket-team-full"><?= Html::encode($team->full_name) ?></div>
                                    </div>
                                    <div class="bracket-team-stats">
                                        <?php $stats = $team->getStandings(); ?>
                                        <span class="stat-badge"><?= $stats['pts'] ?> Pts</span>
                                    </div>
                                </div>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
