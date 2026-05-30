<?php
use yii\helpers\Html;

$this->title = 'Teams';
$groups = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L'];
?>

<div class="team-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="view-toggle">
        <button class="btn btn-primary active" onclick="switchView('table')">Standings (Table)</button>
        <button class="btn btn-secondary" onclick="switchView('bracket')">Bracket View</button>
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
                                        <td class="stat-col">0</td>
                                        <td class="stat-col">0</td>
                                        <td class="stat-col">0</td>
                                        <td class="stat-col">0</td>
                                        <td class="stat-col">0</td>
                                        <td class="stat-col">0</td>
                                        <td class="stat-col">0</td>
                                        <td class="points-col"><strong>0</strong></td>
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

<style>
    .team-index {
        padding: 20px;
        max-width: 1400px;
        margin: 0 auto;
    }

    .view-toggle {
        margin-bottom: 30px;
        display: flex;
        gap: 10px;
    }

    .view-toggle .btn {
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 500;
    }

    .view-toggle .btn.active {
        background: #1f73e6;
        color: white;
    }

    .view-toggle .btn:not(.active) {
        background: #f0f0f0;
        color: #333;
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
        gap: 15px;
        margin-bottom: 20px;
        overflow-x: auto;
    }

    .nav-arrow {
        background: #f0f0f0;
        border: 1px solid #ddd;
        padding: 8px 12px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        flex-shrink: 0;
    }

    .nav-arrow:hover {
        background: #e0e0e0;
    }

    .group-tabs {
        display: flex;
        gap: 8px;
        overflow-x: auto;
        flex: 1;
        padding-bottom: 5px;
    }

    .group-tab {
        background: white;
        border: 1px solid #ddd;
        padding: 8px 16px;
        border-radius: 4px;
        cursor: pointer;
        white-space: nowrap;
        font-size: 13px;
        transition: all 0.2s;
    }

    .group-tab:hover {
        border-color: #1f73e6;
        color: #1f73e6;
    }

    .group-tab.active {
        background: #1f73e6;
        color: white;
        border-color: #1f73e6;
    }

    .group-title {
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #202124;
    }

    .table-wrapper {
        overflow-x: auto;
        border: 1px solid #dadce0;
        border-radius: 8px;
        background: white;
    }

    .standings-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    .standings-table thead {
        background: #f8f9fa;
        border-bottom: 2px solid #dadce0;
    }

    .standings-table th {
        padding: 12px 8px;
        text-align: left;
        font-weight: 600;
        color: #5f6368;
        white-space: nowrap;
    }

    .standings-table td {
        padding: 12px 8px;
        border-bottom: 1px solid #dadce0;
    }

    .standings-table tbody tr:hover {
        background: #f8f9fa;
    }

    .rank-col {
        width: 60px;
        text-align: center;
    }

    .rank-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: #f0f0f0;
        border-radius: 50%;
        font-weight: 600;
        color: #202124;
    }

    .team-col {
        min-width: 200px;
    }

    .team-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .team-flag-large {
        width: 48px;
        height: 48px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #dadce0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.12);
        flex-shrink: 0;
    }

    .team-flag-large.playoff-logo {
        object-fit: contain;
        background: #f8f9fa;
        padding: 4px;
    }

    .team-flag-placeholder {
        width: 48px;
        height: 48px;
        background: #f0f0f0;
        border-radius: 50%;
        border: 2px solid #dadce0;
        flex-shrink: 0;
    }

    .team-names {
        display: flex;
        flex-direction: column;
    }

    .team-name {
        font-weight: 600;
        color: #202124;
        font-size: 14px;
    }

    .team-fullname {
        font-size: 12px;
        color: #5f6368;
        margin-top: 2px;
    }

    .stat-col {
        width: 50px;
        text-align: center;
        color: #5f6368;
    }

    .points-col {
        width: 50px;
        text-align: center;
        font-weight: 600;
        background: #f8f9fa;
    }

    /* BRACKET VIEW STYLES */
    .bracket-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        padding: 20px 0;
    }

    .bracket-group {
        background: white;
        border: 1px solid #dadce0;
        border-radius: 8px;
        padding: 16px;
    }

    .bracket-title {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 16px;
        color: #202124;
        padding-bottom: 12px;
        border-bottom: 2px solid #f0f0f0;
    }

    .bracket-teams {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .bracket-team {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px;
        background: white;
        border: 1px solid #dadce0;
        border-radius: 6px;
        transition: all 0.2s;
        cursor: pointer;
    }

    .bracket-team:hover {
        background: #f8f9fa;
        border-color: #1f73e6;
        box-shadow: 0 2px 8px rgba(31, 115, 230, 0.15);
    }

    .bracket-flag-wrapper {
        flex-shrink: 0;
    }

    .bracket-flag {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid #dadce0;
        box-shadow: 0 2px 6px rgba(0,0,0,0.12);
    }

    .bracket-flag.playoff-logo {
        object-fit: contain;
        background: #f8f9fa;
        padding: 8px;
    }

    .bracket-flag-placeholder {
        width: 64px;
        height: 64px;
        background: #f0f0f0;
        border-radius: 50%;
        border: 2px solid #dadce0;
    }

    .bracket-team-info {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .bracket-team-name {
        font-weight: 600;
        color: #202124;
        font-size: 13px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .bracket-team-full {
        font-size: 11px;
        color: #5f6368;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-top: 2px;
    }

    @media (max-width: 768px) {
        .bracket-container {
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        }

        .team-col {
            min-width: 150px;
        }

        .standings-table {
            font-size: 12px;
        }
    }

    /* DARK THEME OVERRIDES */
    [data-theme="dark"] .team-index {
        color: #e8eaf0;
    }

    [data-theme="dark"] .view-toggle .btn.active {
        background: #7b2fff;
    }

    [data-theme="dark"] .view-toggle .btn:not(.active) {
        background: rgba(255, 255, 255, 0.08);
        color: #e8eaf0;
        border-color: rgba(0, 212, 255, 0.2);
    }

    [data-theme="dark"] .nav-arrow {
        background: rgba(255, 255, 255, 0.08);
        border-color: rgba(0, 212, 255, 0.2);
        color: #e8eaf0;
    }

    [data-theme="dark"] .nav-arrow:hover {
        background: rgba(0, 212, 255, 0.15);
    }

    [data-theme="dark"] .group-tab {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(0, 212, 255, 0.2);
        color: #e8eaf0;
    }

    [data-theme="dark"] .group-tab:hover {
        border-color: #00d4ff;
        color: #00d4ff;
    }

    [data-theme="dark"] .group-tab.active {
        background: #7b2fff;
        color: #ffffff;
        border-color: #7b2fff;
    }

    [data-theme="dark"] .group-title {
        color: #ffffff;
    }

    [data-theme="dark"] .table-wrapper {
        background: rgba(255, 255, 255, 0.02);
        border-color: rgba(0, 212, 255, 0.2);
    }

    [data-theme="dark"] .standings-table thead {
        background: rgba(0, 212, 255, 0.1);
        border-bottom-color: rgba(0, 212, 255, 0.3);
    }

    [data-theme="dark"] .standings-table th {
        color: #00d4ff;
    }

    [data-theme="dark"] .standings-table td {
        color: #d4d8e0;
        border-bottom-color: rgba(0, 212, 255, 0.1);
    }

    [data-theme="dark"] .standings-table tbody tr:hover {
        background: rgba(0, 212, 255, 0.08);
    }

    [data-theme="dark"] .rank-badge {
        background: rgba(0, 212, 255, 0.2);
        color: #00d4ff;
    }

    [data-theme="dark"] .team-name {
        color: #ffffff;
    }

    [data-theme="dark"] .team-fullname {
        color: #8e92a0;
    }

    [data-theme="dark"] .stat-col {
        color: #d4d8e0;
    }

    [data-theme="dark"] .points-col {
        background: rgba(0, 212, 255, 0.1);
        color: #d4d8e0;
    }

    [data-theme="dark"] .bracket-group {
        background: rgba(255, 255, 255, 0.02);
        border-color: rgba(0, 212, 255, 0.2);
    }

    [data-theme="dark"] .bracket-title {
        color: #ffffff;
        border-bottom-color: rgba(0, 212, 255, 0.2);
    }

    [data-theme="dark"] .bracket-team {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(0, 212, 255, 0.2);
    }

    [data-theme="dark"] .bracket-team:hover {
        background: rgba(0, 212, 255, 0.15);
        border-color: #00d4ff;
        box-shadow: 0 2px 8px rgba(0, 212, 255, 0.2);
    }

    [data-theme="dark"] .bracket-team-name {
        color: #ffffff;
    }

    [data-theme="dark"] .bracket-team-full {
        color: #8e92a0;
    }

    [data-theme="dark"] .team-flag-large,
    [data-theme="dark"] .bracket-flag {
        border-color: rgba(0, 212, 255, 0.3);
        box-shadow: 0 2px 8px rgba(0, 212, 255, 0.15);
    }

    [data-theme="dark"] .team-flag-placeholder,
    [data-theme="dark"] .bracket-flag-placeholder {
        background: rgba(0, 212, 255, 0.1);
        border-color: rgba(0, 212, 255, 0.3);
    }

    [data-theme="dark"] .bracket-flag.playoff-logo,
    [data-theme="dark"] .team-flag-large.playoff-logo {
        background: rgba(0, 212, 255, 0.1);
    }
</style>

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

// Initialize first group
document.addEventListener('DOMContentLoaded', function() {
    selectGroup('A');
});
</script>
