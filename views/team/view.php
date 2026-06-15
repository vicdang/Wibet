<?php
use yii\helpers\Html;
use dosamigos\chartjs\ChartJs;

$this->title = $team->name;
$stats = $team->getStandings();
$winRate = $stats['mp'] > 0 ? round($stats['w'] / $stats['mp'] * 100, 1) : 0;
?>

<style>
.team-view {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .team-view {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
}

.team-view-wrapper {
    max-width: 900px;
    margin: 0 auto;
}


.team-header {
    display: flex;
    gap: 30px;
    align-items: flex-start;
    background: var(--card-bg, rgba(255, 255, 255, 0.05));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    padding: 30px;
    margin-bottom: 40px;
}

[data-theme="light"] .team-header {
    background: #ffffff;
    border-color: rgba(0, 0, 0, 0.1);
}

.team-flag-large {
    width: 140px;
    height: 140px;
    border-radius: 12px;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

.team-flag-large img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.team-flag-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.2) 0%, rgba(123, 47, 255, 0.2) 100%);
}

.team-info {
    flex: 1;
}

.team-info h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin: 0 0 12px 0;
    letter-spacing: -0.5px;
}

[data-theme="light"] .team-info h1 {
    color: #1a1a1a;
}

.team-fullname {
    font-size: 1.2rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    margin: 0 0 20px 0;
}

.team-group-badge {
    display: inline-block;
    padding: 8px 16px;
    background: linear-gradient(135deg, rgba(0, 212, 255, 0.2) 0%, rgba(123, 47, 255, 0.2) 100%);
    border: 1px solid rgba(0, 212, 255, 0.3);
    border-radius: 8px;
    font-weight: 700;
    font-size: 1rem;
    letter-spacing: 0.3px;
}

[data-theme="light"] .team-group-badge {
    background: linear-gradient(135deg, rgba(31, 115, 230, 0.15) 0%, rgba(66, 133, 244, 0.15) 100%);
    border-color: rgba(31, 115, 230, 0.3);
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.stat-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.05));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    transition: all 0.3s ease;
}

[data-theme="light"] .stat-card {
    background: #ffffff;
    border-color: rgba(0, 0, 0, 0.1);
}

.stat-card:hover {
    border-color: rgba(0, 212, 255, 0.4);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .stat-card:hover {
    border-color: rgba(31, 115, 230, 0.3);
    box-shadow: 0 8px 24px rgba(31, 115, 230, 0.08);
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 800;
    color: #00d4ff;
    margin: 0 0 8px 0;
    letter-spacing: -0.5px;
}

[data-theme="light"] .stat-value {
    color: #1f73e6;
}

.stat-label {
    font-size: 0.85rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.6));
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

[data-theme="light"] .stat-label {
    color: rgba(0, 0, 0, 0.65);
}

.record-section {
    background: var(--card-bg, rgba(255, 255, 255, 0.05));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    padding: 24px;
}

[data-theme="light"] .record-section {
    background: #ffffff;
    border-color: rgba(0, 0, 0, 0.1);
}

.record-title {
    font-size: 1.1rem;
    font-weight: 700;
    margin: 0 0 20px 0;
    padding-bottom: 12px;
    border-bottom: 2px solid rgba(0, 212, 255, 0.3);
}

[data-theme="light"] .record-title {
    border-bottom-color: rgba(31, 115, 230, 0.2);
}

.record-items {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 16px;
}

.record-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 12px;
    background: rgba(255, 255, 255, 0.02);
    border-radius: 8px;
}

[data-theme="light"] .record-item {
    background: rgba(0, 0, 0, 0.02);
}

.record-number {
    font-size: 1.8rem;
    font-weight: 800;
    color: #00d4ff;
    margin-bottom: 4px;
}

[data-theme="light"] .record-number {
    color: #1f73e6;
}

.record-label {
    font-size: 0.75rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.6));
    text-transform: uppercase;
    letter-spacing: 0.3px;
    font-weight: 600;
}

[data-theme="light"] .record-label {
    color: rgba(0, 0, 0, 0.65);
}

/* Charts Section */
.charts-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-top: 40px;
}

.chart-card {
    background: var(--card-bg, rgba(255, 255, 255, 0.05));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    padding: 24px;
}

[data-theme="light"] .chart-card {
    background: #ffffff;
    border-color: rgba(0, 0, 0, 0.1);
}

.chart-title {
    font-size: 1.1rem;
    font-weight: 700;
    margin: 0 0 20px 0;
    padding-bottom: 12px;
    border-bottom: 2px solid rgba(0, 212, 255, 0.3);
}

[data-theme="light"] .chart-title {
    border-bottom-color: rgba(31, 115, 230, 0.2);
}

.chart-empty {
    text-align: center;
    padding: 30px 0;
    color: var(--text-secondary, rgba(232, 234, 240, 0.6));
}

@media (max-width: 768px) {
    .team-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .team-info h1 {
        font-size: 2rem;
    }

    .stat-value {
        font-size: 2rem;
    }
}
</style>

<div class="team-view">
    <div class="team-view-wrapper">
        <?= $this->render('/common/back-button', ['url' => '/team/index', 'title' => 'Back to Tour']) ?>

        <!-- Team Header -->
        <div class="team-header">
            <div class="team-flag-large">
                <?php $flagUrl = $team->getFlagUrl(); ?>
                <?php if ($flagUrl): ?>
                    <img src="<?= Html::encode($flagUrl) ?>" alt="<?= Html::encode($team->name) ?>">
                <?php elseif ($team->isPlayoffTeam()): ?>
                    <img src="/logo.png" alt="<?= Html::encode($team->name) ?>">
                <?php else: ?>
                    <div class="team-flag-placeholder"></div>
                <?php endif; ?>
            </div>
            <div class="team-info">
                <h1><?= Html::encode($team->name) ?></h1>
                <div class="team-fullname"><?= Html::encode($team->full_name) ?></div>
                <span class="team-group-badge">Group <?= Html::encode($team->group_name) ?></span>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value"><?= $stats['pts'] ?></div>
                <div class="stat-label">Points</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $stats['mp'] ?></div>
                <div class="stat-label">Matches</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $stats['gf'] ?>-<?= $stats['ga'] ?></div>
                <div class="stat-label">Goals For/Against</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $stats['gd'] > 0 ? '+' : '' ?><?= $stats['gd'] ?></div>
                <div class="stat-label">Goal Difference</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $winRate ?>%</div>
                <div class="stat-label">Win Rate</div>
            </div>
        </div>

        <!-- Record Section -->
        <div class="record-section">
            <h3 class="record-title">Match Record</h3>
            <div class="record-items">
                <div class="record-item">
                    <div class="record-number"><?= $stats['w'] ?></div>
                    <div class="record-label">Wins</div>
                </div>
                <div class="record-item">
                    <div class="record-number"><?= $stats['d'] ?></div>
                    <div class="record-label">Draws</div>
                </div>
                <div class="record-item">
                    <div class="record-number"><?= $stats['l'] ?></div>
                    <div class="record-label">Losses</div>
                </div>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="charts-grid">
            <div class="chart-card">
                <h3 class="chart-title">Match Results</h3>
                <?php if ($stats['mp'] > 0): ?>
                    <?= ChartJs::widget([
                        'type' => 'doughnut',
                        'options' => [
                            'height' => 260,
                        ],
                        'clientOptions' => [
                            'legend' => [
                                'display' => true,
                                'position' => 'bottom',
                            ],
                        ],
                        'data' => [
                            'labels' => ['Wins', 'Draws', 'Losses'],
                            'datasets' => [
                                [
                                    'backgroundColor' => [
                                        'rgba(76, 175, 80, 0.7)',
                                        'rgba(255, 193, 7, 0.7)',
                                        'rgba(244, 67, 54, 0.7)',
                                    ],
                                    'borderColor' => [
                                        'rgba(76, 175, 80, 1)',
                                        'rgba(255, 193, 7, 1)',
                                        'rgba(244, 67, 54, 1)',
                                    ],
                                    'data' => [$stats['w'], $stats['d'], $stats['l']],
                                ],
                            ],
                        ],
                    ]) ?>
                <?php else: ?>
                    <div class="chart-empty">No matches played yet</div>
                <?php endif; ?>
            </div>

            <div class="chart-card">
                <h3 class="chart-title">Goals For vs Against</h3>
                <?php if ($stats['mp'] > 0): ?>
                    <?= ChartJs::widget([
                        'type' => 'bar',
                        'options' => [
                            'height' => 260,
                        ],
                        'clientOptions' => [
                            'legend' => [
                                'display' => false,
                            ],
                            'scales' => [
                                'yAxes' => [
                                    [
                                        'ticks' => [
                                            'beginAtZero' => true,
                                            'precision' => 0,
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'data' => [
                            'labels' => ['Goals For', 'Goals Against'],
                            'datasets' => [
                                [
                                    'backgroundColor' => [
                                        'rgba(0, 212, 255, 0.6)',
                                        'rgba(255, 112, 67, 0.6)',
                                    ],
                                    'borderColor' => [
                                        'rgba(0, 212, 255, 1)',
                                        'rgba(255, 112, 67, 1)',
                                    ],
                                    'data' => [$stats['gf'], $stats['ga']],
                                ],
                            ],
                        ],
                    ]) ?>
                <?php else: ?>
                    <div class="chart-empty">No matches played yet</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
