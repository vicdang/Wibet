<?php
use yii\helpers\Html;

$this->title = 'Teams';
$groups = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
?>

<style>
/* Modern Teams Page */
.team-index {
    background: var(--bg-primary, #0a0e1a);
    color: var(--text-primary, #e8eaf0);
    min-height: 100vh;
    padding: 40px 20px;
}

[data-theme="light"] .team-index {
    --bg-primary: #f8f9fa;
    --text-primary: #1a1a1a;
    --text-secondary: rgba(0, 0, 0, 0.65);
    --border-color: rgba(0, 0, 0, 0.1);
    --card-bg: #ffffff;
}

.teams-wrapper {
    max-width: 1400px;
    margin: 0 auto;
}

/* Hero Section */
.teams-hero {
    text-align: center;
    margin-bottom: 50px;
    padding-bottom: 30px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.1));
}

.teams-hero h1 {
    font-size: 3rem;
    font-weight: 800;
    margin: 0 0 16px 0;
    letter-spacing: -1px;
}

[data-theme="light"] .teams-hero h1 {
    color: #1a1a1a;
}

.teams-hero p {
    font-size: 1.1rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.7));
    margin: 0;
}

/* View Toggle */
.view-toggle {
    display: flex;
    gap: 12px;
    margin-bottom: 40px;
    justify-content: center;
    flex-wrap: wrap;
}

.view-toggle .btn {
    padding: 12px 28px;
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.2));
    border-radius: 8px;
    background: transparent;
    color: inherit;
    cursor: pointer;
    font-size: 0.95rem;
    font-weight: 600;
    transition: all 0.3s ease;
    letter-spacing: 0.3px;
}

.view-toggle .btn:hover {
    border-color: #00d4ff;
    color: #00d4ff;
}

.view-toggle .btn.active {
    background: linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 16px rgba(0, 212, 255, 0.3);
}

[data-theme="light"] .view-toggle .btn.active {
    background: linear-gradient(135deg, #1f73e6 0%, #4285f4 100%);
    box-shadow: 0 4px 16px rgba(31, 115, 230, 0.25);
}

.view-content {
    display: none;
}

.view-content.active {
    display: block;
}

/* TABLE VIEW STYLES */
.group-nav {
    display: flex;
    align-items: center;
    gap: 16px;
    margin-bottom: 40px;
    overflow-x: auto;
    padding-bottom: 12px;
}

.nav-arrow {
    background: var(--card-bg, rgba(255, 255, 255, 0.05));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.2));
    padding: 10px 14px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 18px;
    flex-shrink: 0;
    transition: all 0.3s ease;
    color: inherit;
}

.nav-arrow:hover {
    border-color: #00d4ff;
    background: rgba(0, 212, 255, 0.1);
}

[data-theme="light"] .nav-arrow {
    background: #ffffff;
}

.group-tabs {
    display: flex;
    gap: 10px;
    overflow-x: auto;
    flex: 1;
}

.group-tab {
    background: var(--card-bg, rgba(255, 255, 255, 0.03));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    padding: 10px 18px;
    border-radius: 8px;
    cursor: pointer;
    white-space: nowrap;
    font-size: 0.9rem;
    font-weight: 600;
    transition: all 0.3s ease;
    color: inherit;
    letter-spacing: 0.3px;
}

.group-tab:hover {
    border-color: #00d4ff;
    color: #00d4ff;
}

.group-tab.active {
    background: linear-gradient(135deg, #00d4ff 0%, #7b2fff 100%);
    color: white;
    border-color: transparent;
    box-shadow: 0 4px 12px rgba(0, 212, 255, 0.25);
}

[data-theme="light"] .group-tab {
    background: #ffffff;
}

[data-theme="light"] .group-tab.active {
    background: linear-gradient(135deg, #1f73e6 0%, #4285f4 100%);
}

.group-title {
    font-size: 1.8rem;
    font-weight: 700;
    margin: 0 0 24px 0;
    padding-bottom: 16px;
    border-bottom: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
    letter-spacing: -0.5px;
}

[data-theme="light"] .group-title {
    color: #1a1a1a;
}

.table-wrapper {
    overflow-x: auto;
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    margin-bottom: 40px;
}

[data-theme="light"] .table-wrapper {
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.standings-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.9rem;
}

.standings-table thead {
    background: rgba(0, 212, 255, 0.08);
    border-bottom: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
}

[data-theme="light"] .standings-table thead {
    background: rgba(0, 84, 255, 0.04);
    border-bottom-color: var(--border-color);
}

.standings-table th {
    padding: 16px 12px;
    text-align: left;
    font-weight: 700;
    color: #00d4ff;
    letter-spacing: 0.3px;
}

[data-theme="light"] .standings-table th {
    color: #0084ff;
}

.standings-table td {
    padding: 14px 12px;
    border-bottom: 1px solid var(--border-color, rgba(0, 212, 255, 0.08));
}

.standings-table tbody tr:hover {
    background: rgba(0, 212, 255, 0.04);
}

[data-theme="light"] .standings-table tbody tr:hover {
    background: rgba(0, 84, 255, 0.03);
}

.rank-col {
    width: 70px;
    text-align: center;
}

.rank-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    background: rgba(0, 212, 255, 0.15);
    border-radius: 50%;
    font-weight: 700;
    color: #00d4ff;
    font-size: 0.9rem;
}

[data-theme="light"] .rank-badge {
    background: rgba(0, 84, 255, 0.12);
    color: #0084ff;
}

.team-col {
    min-width: 220px;
}

.team-info {
    display: flex;
    align-items: center;
    gap: 14px;
}

.team-flag-large {
    width: 48px;
    height: 48px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
    flex-shrink: 0;
}

.team-flag-large.playoff-logo {
    object-fit: contain;
    background: rgba(0, 212, 255, 0.1);
    padding: 4px;
}

[data-theme="light"] .team-flag-large {
    border-color: rgba(0, 0, 0, 0.12);
}

.team-flag-placeholder {
    width: 48px;
    height: 48px;
    background: rgba(0, 212, 255, 0.1);
    border-radius: 50%;
    border: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
    flex-shrink: 0;
}

[data-theme="light"] .team-flag-placeholder {
    background: rgba(0, 0, 0, 0.05);
    border-color: rgba(0, 0, 0, 0.1);
}

.team-names {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.team-name {
    font-weight: 700;
    font-size: 0.95rem;
    letter-spacing: -0.2px;
}

[data-theme="light"] .team-name {
    color: #1a1a1a;
}

.team-fullname {
    font-size: 0.8rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.6));
}

.stat-col {
    width: 55px;
    text-align: center;
    font-weight: 500;
}

[data-theme="light"] .stat-col {
    color: rgba(0, 0, 0, 0.65);
}

.points-col {
    width: 60px;
    text-align: center;
    font-weight: 700;
    background: rgba(0, 212, 255, 0.1);
    color: #00d4ff;
}

[data-theme="light"] .points-col {
    background: rgba(0, 84, 255, 0.08);
    color: #0084ff;
}

/* BRACKET VIEW STYLES */
.bracket-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 28px;
    margin-bottom: 40px;
}

.bracket-group {
    background: var(--card-bg, rgba(255, 255, 255, 0.02));
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 12px;
    padding: 24px;
    transition: all 0.3s ease;
}

.bracket-group:hover {
    border-color: rgba(0, 212, 255, 0.3);
    box-shadow: 0 8px 24px rgba(0, 212, 255, 0.1);
    transform: translateY(-4px);
}

[data-theme="light"] .bracket-group {
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .bracket-group:hover {
    box-shadow: 0 8px 24px rgba(0, 84, 255, 0.08);
}

.bracket-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin: 0 0 18px 0;
    padding-bottom: 14px;
    border-bottom: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
    letter-spacing: -0.3px;
}

[data-theme="light"] .bracket-title {
    color: #1a1a1a;
}

.bracket-teams {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.bracket-team {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px;
    background: rgba(0, 212, 255, 0.04);
    border: 1px solid var(--border-color, rgba(0, 212, 255, 0.15));
    border-radius: 8px;
    transition: all 0.3s ease;
    cursor: pointer;
}

.bracket-team:hover {
    background: rgba(0, 212, 255, 0.1);
    border-color: rgba(0, 212, 255, 0.3);
    transform: translateX(4px);
}

[data-theme="light"] .bracket-team {
    background: rgba(0, 84, 255, 0.03);
}

[data-theme="light"] .bracket-team:hover {
    background: rgba(0, 84, 255, 0.1);
}

.bracket-flag-wrapper {
    flex-shrink: 0;
}

.bracket-flag {
    width: 64px;
    height: 64px;
    object-fit: cover;
    border-radius: 50%;
    border: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
}

.bracket-flag.playoff-logo {
    object-fit: contain;
    background: rgba(0, 212, 255, 0.1);
    padding: 8px;
}

[data-theme="light"] .bracket-flag {
    border-color: rgba(0, 0, 0, 0.12);
}

.bracket-flag-placeholder {
    width: 64px;
    height: 64px;
    background: rgba(0, 212, 255, 0.1);
    border-radius: 50%;
    border: 2px solid var(--border-color, rgba(0, 212, 255, 0.2));
}

[data-theme="light"] .bracket-flag-placeholder {
    background: rgba(0, 0, 0, 0.05);
    border-color: rgba(0, 0, 0, 0.1);
}

.bracket-team-info {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 3px;
    min-width: 0;
}

.bracket-team-name {
    font-weight: 700;
    font-size: 0.9rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    letter-spacing: -0.2px;
}

[data-theme="light"] .bracket-team-name {
    color: #1a1a1a;
}

.bracket-team-full {
    font-size: 0.75rem;
    color: var(--text-secondary, rgba(232, 234, 240, 0.6));
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

/* Responsive */
@media (max-width: 1024px) {
    .teams-wrapper {
        max-width: 100%;
    }

    .bracket-container {
        grid-template-columns: repeat(auto-fill, minmax(270px, 1fr));
        gap: 20px;
    }
}

@media (max-width: 768px) {
    .team-index {
        padding: 20px 16px;
    }

    .teams-hero {
        margin-bottom: 36px;
        padding-bottom: 24px;
    }

    .teams-hero h1 {
        font-size: 2rem;
    }

    .teams-hero p {
        font-size: 0.95rem;
    }

    .view-toggle {
        margin-bottom: 32px;
        gap: 10px;
    }

    .view-toggle .btn {
        padding: 10px 20px;
        font-size: 0.85rem;
    }

    .group-nav {
        gap: 12px;
        margin-bottom: 32px;
    }

    .group-title {
        font-size: 1.4rem;
        margin-bottom: 18px;
    }

    .bracket-container {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 16px;
    }

    .standings-table {
        font-size: 0.8rem;
    }

    .standings-table th {
        padding: 12px 8px;
    }

    .standings-table td {
        padding: 10px 8px;
    }

    .team-col {
        min-width: 160px;
    }

    .team-flag-large {
        width: 42px;
        height: 42px;
    }

    .team-fullname {
        font-size: 0.75rem;
    }
}

@media (max-width: 480px) {
    .team-index {
        padding: 16px 12px;
    }

    .teams-hero h1 {
        font-size: 1.6rem;
        margin-bottom: 12px;
    }

    .teams-hero p {
        font-size: 0.9rem;
    }

    .view-toggle {
        gap: 8px;
        margin-bottom: 24px;
    }

    .view-toggle .btn {
        padding: 8px 16px;
        font-size: 0.8rem;
    }

    .group-nav {
        gap: 8px;
        margin-bottom: 24px;
    }

    .group-tabs {
        gap: 6px;
    }

    .group-tab {
        padding: 8px 14px;
        font-size: 0.8rem;
    }

    .nav-arrow {
        padding: 8px 10px;
    }

    .group-title {
        font-size: 1.2rem;
    }

    .bracket-container {
        grid-template-columns: 1fr;
    }

    .bracket-group {
        padding: 18px;
    }

    .bracket-title {
        font-size: 1.1rem;
    }

    .bracket-flag {
        width: 56px;
        height: 56px;
    }

    .standings-table {
        font-size: 0.75rem;
    }

    .standings-table th {
        padding: 10px 6px;
    }

    .standings-table td {
        padding: 8px 6px;
    }

    .team-col {
        min-width: 140px;
    }

    .team-info {
        gap: 10px;
    }

    .team-flag-large {
        width: 40px;
        height: 40px;
    }

    .rank-badge {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }
}
</style>

<div class="team-index">
    <div class="teams-wrapper">
        <!-- Hero Section -->
        <!-- <div class="teams-hero">
            <h1><?= Html::encode($this->title) ?></h1>
            <p>Explore all 48 teams competing in the FIFA World Cup 2026</p>
        </div> -->

        <!-- View Toggle -->
        <div class="view-toggle">
            <button class="btn active" onclick="switchView('table')">📊 Standings Table</button>
            <button class="btn" onclick="switchView('bracket')">🏆 Bracket View</button>
        </div>

        <!-- TABLE VIEW -->
        <div id="table-view" class="view-content active">
            <div class="group-nav">
                <button class="nav-arrow" onclick="prevGroup()">❮</button>
                <div class="group-tabs">
                    <?php foreach ($groups as $group): ?>
                        <button class="group-tab" data-group="<?= $group ?>" onclick="selectGroup('<?= $group ?>')">
                            Group <?= $group ?>
                        </button>
                    <?php endforeach; ?>
                </div>
                <button class="nav-arrow" onclick="nextGroup()">❯</button>
            </div>

            <div class="tables-container">
                <?php foreach ($groups as $group): ?>
                    <div class="group-table" data-group="<?= $group ?>" style="display: <?= $group === 'A' ? 'block' : 'none' ?>;">
                        <h3 class="group-title">Group <?= $group ?></h3>
                        <div class="table-wrapper">
                            <table class="standings-table">
                                <thead>
                                    <tr>
                                        <th class="rank-col">Rank</th>
                                        <th class="team-col">Team</th>
                                        <th class="stat-col" title="Matches Played">MP</th>
                                        <th class="stat-col" title="Wins">W</th>
                                        <th class="stat-col" title="Draws">D</th>
                                        <th class="stat-col" title="Losses">L</th>
                                        <th class="stat-col" title="Goals For">GF</th>
                                        <th class="stat-col" title="Goals Against">GA</th>
                                        <th class="stat-col" title="Goal Difference">GD</th>
                                        <th class="points-col" title="Points">Pts</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $groupTeams = $groupedTeams[$group] ?? [];
                                    $rank = 1;
                                    foreach ($groupTeams as $team):
                                    ?>
                                        <tr class="team-row">
                                            <td class="rank-col">
                                                <span class="rank-badge"><?= $rank ?></span>
                                            </td>
                                            <td class="team-col">
                                                <div class="team-info">
                                                    <?php $flagUrl = $team->getFlagUrl(); ?>
                                                    <?php if ($flagUrl): ?>
                                                        <img src="<?= Html::encode($flagUrl) ?>" alt="<?= Html::encode($team->name) ?>" class="team-flag-large">
                                                    <?php elseif ($team->isPlayoffTeam()): ?>
                                                        <img src="/logo.png" alt="<?= Html::encode($team->name) ?>" class="team-flag-large playoff-logo">
                                                    <?php else: ?>
                                                        <div class="team-flag-placeholder"></div>
                                                    <?php endif; ?>
                                                    <div class="team-names">
                                                        <div class="team-name"><?= Html::encode($team->name) ?></div>
                                                        <div class="team-fullname"><?= Html::encode($team->full_name) ?></div>
                                                    </div>
                                                </div>
                                            </td>
                                            <?php $stats = $team->getStandings(); ?>
                                            <td class="stat-col"><?= $stats['mp'] ?></td>
                                            <td class="stat-col"><?= $stats['w'] ?></td>
                                            <td class="stat-col"><?= $stats['d'] ?></td>
                                            <td class="stat-col"><?= $stats['l'] ?></td>
                                            <td class="stat-col"><?= $stats['gf'] ?></td>
                                            <td class="stat-col"><?= $stats['ga'] ?></td>
                                            <td class="stat-col"><?= $stats['gd'] ?></td>
                                            <td class="points-col"><strong><?= $stats['pts'] ?></strong></td>
                                        </tr>
                                    <?php
                                    $rank++;
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- BRACKET VIEW -->
        <div id="bracket-view" class="view-content">
            <div class="bracket-container">
                <?php foreach ($groups as $group): ?>
                    <div class="bracket-group">
                        <h4 class="bracket-title">Group <?= $group ?></h4>
                        <div class="bracket-teams">
                            <?php
                            $groupTeams = $groupedTeams[$group] ?? [];
                            foreach ($groupTeams as $team):
                            ?>
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
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
function switchView(view) {
    document.querySelectorAll('.view-content').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.view-toggle .btn').forEach(el => el.classList.remove('active'));

    document.getElementById(view + '-view').classList.add('active');
    event.target.classList.add('active');
}

function selectGroup(group) {
    document.querySelectorAll('.group-table').forEach(el => el.style.display = 'none');
    document.querySelectorAll('.group-tab').forEach(el => el.classList.remove('active'));

    document.querySelector('[data-group="' + group + '"].group-table').style.display = 'block';
    document.querySelector('[data-group="' + group + '"].group-tab').classList.add('active');
}

function prevGroup() {
    const groups = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
    const current = document.querySelector('.group-tab.active').dataset.group;
    const idx = groups.indexOf(current);
    if (idx > 0) selectGroup(groups[idx - 1]);
}

function nextGroup() {
    const groups = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
    const current = document.querySelector('.group-tab.active').dataset.group;
    const idx = groups.indexOf(current);
    if (idx < groups.length - 1) selectGroup(groups[idx + 1]);
}

document.addEventListener('DOMContentLoaded', function() {
    selectGroup('A');
});
</script>
