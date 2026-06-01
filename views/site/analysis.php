<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\Helper;
use dosamigos\chartjs\ChartJs;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\BetSearch $searchModel
 */

$this->title = 'Analysis';
?>

<style>
    .analysis-page {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .analysis-page [data-theme="light"] {
        --bg-primary: #f8f9fa;
        --text-primary: #1a1a1a;
        --text-secondary: rgba(0, 0, 0, 0.65);
        --border-color: rgba(0, 0, 0, 0.1);
        --card-bg: #ffffff;
        --accent-color: #0084ff;
        --stat-color: #0084ff;
    }

    .analysis-page [data-theme="dark"] {
        --text-primary: #e8eaf0;
        --text-secondary: rgba(232, 234, 240, 0.7);
        --border-color: rgba(0, 212, 255, 0.15);
        --card-bg: rgba(255, 255, 255, 0.02);
        --accent-color: #00d4ff;
        --stat-color: #00d4ff;
    }

    .page-header {
        margin: 40px 0 50px;
        text-align: center;
    }

    .page-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0 0 8px;
    }

    .page-header p {
        font-size: 1rem;
        color: var(--text-secondary);
        margin: 0;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr 1fr;
        gap: 20px;
        margin-bottom: 50px;
    }

    @media (max-width: 1200px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }
    }

    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        border-color: var(--accent-color);
        box-shadow: 0 8px 24px rgba(0, 212, 255, 0.12);
        transform: translateY(-3px);
    }

    .stat-card.featured {
        grid-column: 1;
        grid-row: 1 / 3;
    }

    .stat-card-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 6px;
        background: rgba(0, 212, 255, 0.1);
        color: var(--accent-color);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-card-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0 0 12px;
    }

    .stat-card-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--stat-color);
        line-height: 1;
        margin: 0;
    }

    .stat-card.featured .stat-card-value {
        font-size: 3.2rem;
    }

    .stat-card-desc {
        font-size: 0.9rem;
        color: var(--text-secondary);
        margin-top: 8px;
    }

    .achievements-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 50px;
    }

    .achievement-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 28px 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .achievement-card:hover {
        border-color: var(--accent-color);
        box-shadow: 0 8px 24px rgba(0, 212, 255, 0.12);
        transform: translateY(-3px);
    }

    .achievement-card.king {
        border-color: rgba(255, 215, 0, 0.3);
        background: rgba(255, 215, 0, 0.05);
    }

    .achievement-card.king:hover {
        border-color: rgba(255, 215, 0, 0.5);
        box-shadow: 0 8px 24px rgba(255, 215, 0, 0.15);
    }

    .achievement-label {
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0 0 12px;
    }

    .achievement-value {
        font-size: 1.6rem;
        font-weight: 800;
        color: var(--text-primary);
        margin: 0;
        word-break: break-word;
    }

    .quick-stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
        margin-bottom: 50px;
    }

    .quick-stat-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 28px 20px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .quick-stat-card:hover {
        border-color: var(--accent-color);
        box-shadow: 0 8px 24px rgba(0, 212, 255, 0.12);
        transform: translateY(-3px);
    }

    .quick-stat-number {
        font-size: 2.8rem;
        font-weight: 800;
        color: var(--stat-color);
        line-height: 1;
        margin: 0 0 12px;
    }

    .quick-stat-label {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 0;
    }

    .charts-grid {
        display: grid;
        gap: 20px;
        margin-bottom: 50px;
    }

    .charts-row-3 {
        display: grid;
        grid-template-columns: 5fr 3fr 4fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    @media (max-width: 1200px) {
        .charts-row-3 {
            grid-template-columns: 1fr;
        }
    }

    .charts-row-2 {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }

    @media (max-width: 1000px) {
        .charts-row-2 {
            grid-template-columns: 1fr;
        }
    }

    .charts-row-centered {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 20px;
    }

    .chart-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 12px;
        padding: 24px;
        transition: all 0.3s ease;
    }

    .chart-card:hover {
        border-color: var(--accent-color);
        box-shadow: 0 8px 24px rgba(0, 212, 255, 0.12);
    }

    .chart-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 20px;
        padding-bottom: 12px;
        border-bottom: 1px solid var(--border-color);
    }

    .chart-container {
        position: relative;
    }
</style>

<div class="analysis-page">
    <?php
        $params = Yii::$app->params;
        $total_amount = $params['totalAmount'];
        $bet_times = array();
        $win_times = array();
        $usernames = array();
        $win_rates = array();
        $total = array();
        $available = array();
        foreach ($rankingDataProvider->getModels() as $key => $value) {
            array_push($win_times, $value['win_times']);
            array_push($usernames, $value['username']);
            array_push($bet_times, $value['bet_times']);
            array_push($win_rates, $value['win_rate']);
            array_push($total, $value['total_money']);
            array_push($available, $value['money']);
        }

        $survival = count(array_filter($total, function($value) {
            return $value > 0;
        }));
        $betman = count($usernames);
        $bankruptcy = $betman - $survival;
        $totalw = array_sum($total);

        $kingbet = '';
        if (!empty($total)) {
            $max_kb = max($total);
            $max_indices_kb = array_keys($total, $max_kb);
            $max_index_kb = $max_indices_kb[0];
            $kingbet = $usernames[$max_index_kb];
        }

        $betprophet = '';
        if (!empty($win_times)) {
            $max_bp = max($win_times);
            $max_indices_bp = array_keys($win_times, $max_bp);
            $max_index_bp = $max_indices_bp[0];
            $betprophet = $usernames[$max_index_bp];
        }

        $betresilent = '';
        if (!empty($bet_times)) {
            $max_br = max($bet_times);
            $max_indices_br = array_keys($bet_times, $max_br);
            $max_index_br = $max_indices_br[0];
            $betresilent = $usernames[$max_index_br];
        }

        $trendsetter = '';
        if (!empty($win_rates)) {
            $max_bt = max($win_rates);
            $max_indices_bt = array_keys($win_rates, $max_bt);
            $max_index_bt = $max_indices_bt[0];
            $trendsetter = $usernames[$max_index_bt];
        }

        $p1 = Helper::calculatePrices($total_amount, $params['p1Rate'], $params['p1Count']);
        $p2 = Helper::calculatePrices($total_amount, $params['p2Rate'], $params['p2Count']);
        $p3 = Helper::calculatePrices($total_amount, $params['p3Rate'], $params['p3Count']);
        $p4 = Helper::calculatePrices($total_amount, $params['p4Rate'], $params['p4Count']);
    ?>

    <!-- Page Header -->
    <div class="page-header">
        <h1>Analysis</h1>
        <p>Season statistics and leaderboard insights</p>
    </div>

    <!-- Prize Pool Section -->
    <div class="stats-grid">
        <div class="stat-card featured">
            <div class="stat-card-label">Total Prize Pool</div>
            <div class="stat-card-value"><?php echo number_format($total_amount, 0) ?></div>
            <div class="stat-card-desc"><?= $params['currencyReal'] ?></div>
        </div>
        <div class="stat-card">
            <div class="stat-card-badge">~<?= $params['p1Rate'] ?>%</div>
            <div class="stat-card-label">Diamond</div>
            <div class="stat-card-value"><?= $params['p1Count'] ?></div>
            <div class="stat-card-desc"><?= $p1['price']?><?= $params['currencyReal']?></div>
        </div>
        <div class="stat-card">
            <div class="stat-card-badge">~<?= $params['p2Rate'] ?>%</div>
            <div class="stat-card-label">Platinum</div>
            <div class="stat-card-value"><?= $params['p2Count'] ?></div>
            <div class="stat-card-desc"><?= $p2['price']?><?= $params['currencyReal']?></div>
        </div>
        <div class="stat-card">
            <div class="stat-card-badge">~<?= $params['p3Rate'] ?>%</div>
            <div class="stat-card-label">Gold</div>
            <div class="stat-card-value"><?= $params['p3Count'] ?></div>
            <div class="stat-card-desc"><?= $p3['price']?><?= $params['currencyReal']?></div>
        </div>
        <div class="stat-card">
            <div class="stat-card-badge">~<?= $params['p4Rate'] ?>%</div>
            <div class="stat-card-label">Silver</div>
            <div class="stat-card-value"><?= $params['p4Count'] ?></div>
            <div class="stat-card-desc"><?= $p4['price']?><?= $params['currencyReal']?></div>
        </div>
    </div>

    <!-- Hall of Fame Section -->
    <div class="achievements-grid">
        <div class="achievement-card king">
            <div class="achievement-label">Prediction King</div>
            <div class="achievement-value"><?php echo $kingbet ?></div>
        </div>
        <div class="achievement-card">
            <div class="achievement-label">Prediction Prophet</div>
            <div class="achievement-value"><?php echo $betprophet ?></div>
        </div>
        <div class="achievement-card">
            <div class="achievement-label">Trend Setter</div>
            <div class="achievement-value"><?php echo $trendsetter ?></div>
        </div>
        <div class="achievement-card">
            <div class="achievement-label">Prediction Resilient</div>
            <div class="achievement-value"><?php echo $betresilent ?></div>
        </div>
    </div>

    <!-- Quick Stats Section -->
    <div class="quick-stats-grid">
        <div class="quick-stat-card">
            <div class="quick-stat-number"><?php echo $betman ?></div>
            <div class="quick-stat-label">Total Players</div>
        </div>
        <div class="quick-stat-card">
            <div class="quick-stat-number"><?php echo $survival ?></div>
            <div class="quick-stat-label">Survival</div>
        </div>
        <div class="quick-stat-card">
            <div class="quick-stat-number"><?php echo $bankruptcy ?></div>
            <div class="quick-stat-label">Bankruptcy</div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="charts-grid">
        <!-- Top Rankings Row -->
        <div class="charts-row-3">
            <div class="chart-card">
                <div class="chart-title">Top 3 Rankings</div>
                <div class="chart-container">
                    <?= ChartJs::widget([
                        'type' => 'bar',
                        'options' => [
                            'indexAxis' => 'y',
                            'height' => 60,
                            'width' => 100,
                            'scales' => [
                                'y' => ['beginAtZero' => true, 'stacked' => true],
                                'x' => ['stacked' => true]
                            ]
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'tooltips' => ['enabled' => true],
                        ],
                        'data' => [
                            'labels' => array_slice($usernames, 0, 3),
                            'datasets' => [[
                                'label' => "Points",
                                'backgroundColor' => 'rgba(0, 212, 255, 0.6)',
                                'borderColor' => "rgba(0, 212, 255, 1)",
                                'minBarLength' => 1,
                                'barThickness' => 30,
                                'data' => array_slice($total, 0, 3)
                            ]]
                        ]
                    ]); ?>
                </div>
            </div>
            <div class="chart-card">
                <div class="chart-title">Top 10 Rankings</div>
                <div class="chart-container">
                    <?= ChartJs::widget([
                        'type' => 'bar',
                        'options' => [
                            'height' => 65,
                            'width' => 100,
                            'scales' => ['y' => ['beginAtZero' => true]]
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'tooltips' => ['enabled' => true],
                        ],
                        'data' => [
                            'labels' => array_slice($usernames, 0, 10),
                            'datasets' => [[
                                'label' => "Points",
                                'backgroundColor' => 'rgba(75, 192, 192, 0.6)',
                                'borderColor' => "rgba(75, 192, 192, 1)",
                                'data' => array_slice($total, 0, 10)
                            ]]
                        ]
                    ]); ?>
                </div>
            </div>
            <div class="chart-card">
                <div class="chart-title">Top 20 Rankings</div>
                <div class="chart-container">
                    <?= ChartJs::widget([
                        'type' => 'bar',
                        'options' => [
                            'height' => 70,
                            'width' => 100,
                            'scales' => ['y' => ['beginAtZero' => true]]
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'tooltips' => ['enabled' => true],
                        ],
                        'data' => [
                            'labels' => array_slice($usernames, 0, 20),
                            'datasets' => [[
                                'label' => "Points",
                                'backgroundColor' => 'rgba(255, 99, 132, 0.6)',
                                'borderColor' => "rgba(255, 99, 132, 1)",
                                'data' => array_slice($total, 0, 20)
                            ]]
                        ]
                    ]); ?>
                </div>
            </div>
        </div>

        <!-- Win/Bet Times Line Chart -->
        <div class="chart-card">
            <div class="chart-title">Win Times vs Bet Times</div>
            <div class="chart-container">
                <?= ChartJs::widget([
                    'type' => 'line',
                    'options' => [
                        'height' => 30,
                        'width' => 100,
                        'scales' => ['y' => ['stacked' => true]]
                    ],
                    'clientOptions' => [
                        'legend' => ['display' => true, 'position' => 'top'],
                        'tooltips' => ['enabled' => true],
                    ],
                    'data' => [
                        'labels' => $usernames,
                        'datasets' => [
                            [
                                'label' => "Bet Times",
                                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                                'borderColor' => 'rgba(54, 162, 235, 1)',
                                'pointRadius' => 3,
                                'spanGaps' => true,
                                'data' => $bet_times
                            ],
                            [
                                'label' => "Win Times",
                                'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                                'borderColor' => "rgba(255, 99, 132, 1)",
                                'pointRadius' => 3,
                                'spanGaps' => true,
                                'data' => $win_times
                            ]
                        ]
                    ]
                ]); ?>
            </div>
        </div>

        <!-- Win Rates & Distribution Row -->
        <div class="charts-row-3">
            <div class="chart-card">
                <div class="chart-title">Win Rates</div>
                <div class="chart-container">
                    <?= ChartJs::widget([
                        'type' => 'bar',
                        'options' => [
                            'height' => 70,
                            'width' => 100,
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'tooltips' => ['enabled' => true],
                        ],
                        'data' => [
                            'labels' => $usernames,
                            'datasets' => [[
                                'label' => "Win Rate",
                                'backgroundColor' => 'rgba(255, 99, 132, 0.6)',
                                'borderColor' => 'rgba(255, 99, 132, 1)',
                                'data' => $win_rates
                            ]]
                        ]
                    ]); ?>
                </div>
            </div>
            <div class="chart-card">
                <div class="chart-title">Top 10 Distribution</div>
                <div class="chart-container">
                    <?= ChartJs::widget([
                        'type' => 'pie',
                        'options' => [
                            'height' => 400,
                            'width' => 400
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => true, 'position' => 'left'],
                            'tooltips' => ['enabled' => true],
                        ],
                        'data' => [
                            'labels' => array_slice($usernames, 0, 10),
                            'datasets' => [[
                                'backgroundColor' => [
                                    'rgba(255, 99, 132, 0.7)',
                                    'rgba(255, 159, 64, 0.7)',
                                    'rgba(255, 205, 86, 0.7)',
                                    'rgba(75, 192, 192, 0.7)',
                                    'rgba(54, 162, 235, 0.7)',
                                    'rgba(153, 102, 255, 0.7)',
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(75, 192, 192, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(201, 203, 207, 0.7)'
                                ],
                                'borderColor' => [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 205, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(201, 203, 207, 1)'
                                ],
                                'data' => array_slice($total, 0, 10)
                            ]]
                        ]
                    ]); ?>
                </div>
            </div>
            <div class="chart-card">
                <div class="chart-title">Bet vs Win Analysis</div>
                <div class="chart-container">
                    <?= ChartJs::widget([
                        'type' => 'doughnut',
                        'options' => [
                            'height' => 400,
                            'width' => 400,
                            'maintainAspectRatio' => false,
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => true, 'position' => 'left'],
                            'tooltips' => ['enabled' => true],
                        ],
                        'data' => [
                            'labels' => array_slice($usernames, 0, 10),
                            'datasets' => [
                                [
                                    'label' => "Bet Times",
                                    'backgroundColor' => [
                                        'rgba(255, 99, 132, 0.5)',
                                        'rgba(255, 159, 64, 0.5)',
                                        'rgba(255, 205, 86, 0.5)',
                                        'rgba(75, 192, 192, 0.5)',
                                        'rgba(54, 162, 235, 0.5)',
                                        'rgba(153, 102, 255, 0.5)',
                                        'rgba(201, 203, 207, 0.5)',
                                        'rgba(255, 99, 132, 0.3)',
                                        'rgba(75, 192, 192, 0.3)',
                                        'rgba(54, 162, 235, 0.3)'
                                    ],
                                    'borderColor' => [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(255, 205, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(201, 203, 207, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(54, 162, 235, 1)'
                                    ],
                                    'hoverOffset' => 5,
                                    'data' => array_slice($bet_times, 0, 10)
                                ],
                                [
                                    'label' => "Win Times",
                                    'backgroundColor' => [
                                        'rgba(255, 99, 132, 0.8)',
                                        'rgba(255, 159, 64, 0.8)',
                                        'rgba(255, 205, 86, 0.8)',
                                        'rgba(75, 192, 192, 0.8)',
                                        'rgba(54, 162, 235, 0.8)',
                                        'rgba(153, 102, 255, 0.8)',
                                        'rgba(201, 203, 207, 0.8)',
                                        'rgba(255, 99, 132, 0.6)',
                                        'rgba(75, 192, 192, 0.6)',
                                        'rgba(54, 162, 235, 0.6)'
                                    ],
                                    'borderColor' => [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(255, 159, 64, 1)',
                                        'rgba(255, 205, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(201, 203, 207, 1)',
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(54, 162, 235, 1)'
                                    ],
                                    'borderWidth' => 1,
                                    'hoverOffset' => 5,
                                    'data' => array_slice($win_times, 0, 10)
                                ]
                            ]
                        ]
                    ]); ?>
                </div>
            </div>
        </div>

        <!-- Total vs Available Balance -->
        <div class="chart-card">
            <div class="chart-title">Total Balance vs Available Funds</div>
            <div class="chart-container">
                <?= ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'responsive' => true,
                        'maintainAspectRatio' => true,
                        'height' => 30,
                        'width' => 100,
                        'scales' => [
                            'y' => ['stacked' => false],
                            'x' => ['stacked' => false]
                        ]
                    ],
                    'clientOptions' => [
                        'legend' => ['display' => true, 'position' => 'top'],
                        'tooltips' => ['enabled' => true],
                    ],
                    'data' => [
                        'labels' => $usernames,
                        'datasets' => [
                            [
                                'label' => "Total",
                                'backgroundColor' => 'rgba(54, 162, 235, 0.6)',
                                'borderColor' => 'rgba(54, 162, 235, 1)',
                                'spanGaps' => true,
                                'data' => $total
                            ],
                            [
                                'label' => "Available",
                                'backgroundColor' => 'rgba(255, 99, 132, 0.6)',
                                'borderColor' => "rgba(255, 99, 132, 1)",
                                'spanGaps' => true,
                                'data' => $available
                            ]
                        ]
                    ]
                ]); ?>
            </div>
        </div>

        <!-- Advanced Analytics Row -->
        <div class="charts-row-centered">
            <div class="chart-card" style="grid-column: 2;">
                <div class="chart-title">Win Rate Analysis</div>
                <div class="chart-container">
                    <?= ChartJs::widget([
                        'type' => 'radar',
                        'options' => [
                            'height' => 70,
                            'width' => 100,
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'tooltips' => ['enabled' => true],
                        ],
                        'data' => [
                            'labels' => $usernames,
                            'datasets' => [[
                                'label' => "Win Rate",
                                'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
                                'borderColor' => 'rgba(255, 99, 132, 1)',
                                'pointBackgroundColor' => 'rgba(255, 99, 132, 1)',
                                'pointRadius' => 3,
                                'data' => $win_rates
                            ]]
                        ]
                    ]); ?>
                </div>
            </div>
            <div class="chart-card" style="grid-column: 3;">
                <div class="chart-title">Polar Distribution</div>
                <div class="chart-container">
                    <?= ChartJs::widget([
                        'type' => 'polarArea',
                        'options' => [
                            'indexAxis' => 'y',
                            'height' => 60,
                            'width' => 100,
                        ],
                        'clientOptions' => [
                            'legend' => ['display' => false],
                            'tooltips' => ['enabled' => true],
                        ],
                        'data' => [
                            'labels' => array_slice($usernames, 0, 10),
                            'datasets' => [[
                                'label' => "Win Times",
                                'backgroundColor' => [
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(255, 159, 64, 0.5)',
                                    'rgba(255, 205, 86, 0.5)',
                                    'rgba(75, 192, 192, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(153, 102, 255, 0.5)',
                                    'rgba(201, 203, 207, 0.5)',
                                    'rgba(255, 99, 132, 0.3)',
                                    'rgba(75, 192, 192, 0.3)',
                                    'rgba(54, 162, 235, 0.3)'
                                ],
                                'borderColor' => [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(255, 159, 64, 1)',
                                    'rgba(255, 205, 86, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(54, 162, 235, 1)',
                                    'rgba(153, 102, 255, 1)',
                                    'rgba(201, 203, 207, 1)',
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(75, 192, 192, 1)',
                                    'rgba(54, 162, 235, 1)'
                                ],
                                'hoverOffset' => 5,
                                'data' => array_slice($win_times, 0, 10)
                            ]]
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
