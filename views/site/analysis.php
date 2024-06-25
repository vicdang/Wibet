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
<div class="row">
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
        // print_r($value);
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
    // King bet
    $max_kb = max($total);
    $max_indices_kb = array_keys($total, $max_kb);
    $max_index_kb = $max_indices_kb[0];
    $kingbet = $usernames[$max_index_kb];
    // Bet Prophet
    $max_bp = max($win_times);
    $max_indices_bp = array_keys($win_times, $max_bp);
    $max_index_bp = $max_indices_bp[0];
    $betprophet = $usernames[$max_index_bp];
    // Bet Resilent
    $max_br = max($bet_times);
    $max_indices_br = array_keys($bet_times, $max_br);
    $max_index_br = $max_indices_br[0];
    $betresilent = $usernames[$max_index_br];
    // Trendsetter
    $max_bt = max($win_rates);
    $max_indices_bt = array_keys($win_rates, $max_bt);
    $max_index_bt = $max_indices_bt[0];
    $trendsetter = $usernames[$max_index_bt];

    $p1 = Helper::calculatePrices($total_amount, $params['p1Rate'], $params['p1Count']);
    $p2 = Helper::calculatePrices($total_amount, $params['p2Rate'], $params['p2Count']);
    $p3 = Helper::calculatePrices($total_amount, $params['p3Rate'], $params['p3Count']);
    $p4 = Helper::calculatePrices($total_amount, $params['p4Rate'], $params['p4Count']);
?>

<div class="container dashboard">
<div class="row">
        <div class="card col-lg-4">
            <!-- <div class="badge-overlay">
                <span class="top-right badges blue">upto</span>
            </div> -->
            <div class="ribbon blue"><span>HOT</span></div>
            <div class="panel-group block">
                <div class="panel panel-default">
                    <div class="panel-heading">TOTAL PRIZE POOL</div>
                    <div class="panel-body"><?php echo number_format($total_amount,0) ?><?= $params['currencyReal'] ?></div>
                </div>
            </div>
        </div>
        <div class="card col-lg-2">
            <div class="panel-group">
            <!-- <div class="badge-overlay">
                <span class="top-right badges red"><?= $params['p1Rate'] ?>%</span>
            </div> -->
            <div class="ribbon orange"><span>~<?= $params['p1Rate'] ?>%</span></div>
                <div class="panel panel-danger animated-box in">
                    <div class="panel-heading">DIAMON x <?= $params['p1Count'] ?></div>
                    <div class="panel-body"><?= $p1['price']?><?= $params['currencyReal']?></div>
                </div>
            </div>
        </div>
        <div class="card col-lg-2">
            <div class="panel-group">
            <!-- <div class="badge-overlay">
                <span class="top-right badges orange"><?= $params['p2Rate'] ?>%</span>
            </div> -->
            <div class="ribbon red"><span>~<?= $params['p2Rate']?>%</span></div>
                <div class="panel panel-success">
                <div class="panel-heading">PLATINUM x <?= $params['p2Count'] ?></div>
                <div class="panel-body"><?= $p2['price']?><?= $params['currencyReal']?></div>
                </div>
            </div>
        </div>
        <div class="card col-lg-2">
            <div class="panel-group">
            <!-- <div class="badge-overlay">
                <span class="top-right badges pink"><?= $params['p3Rate'] ?>%</span>
            </div> -->
            <div class="ribbon blue"><span>~<?= $params['p3Rate']?>%</span></div>
                <div class="panel panel-warning">
                <div class="panel-heading">GOLD x <?= $params['p3Count'] ?></div>
                <div class="panel-body"><?= $p3['price']?><?= $params['currencyReal']?></div>
                </div>
            </div>
        </div>
        <div class="card col-lg-2">
            <div class="panel-group">
            <!-- <div class="badge-overlay">
                <span class="top-right badges green"><?= $params['p4Rate'] ?>%</span>
            </div> -->
            <div class="ribbon green"><span>~<?= $params['p4Rate']?>%</span></div>
                <div class="panel panel-info">
                <div class="panel-heading">SILVER x <?= $params['p4Count'] ?></div>
                <div class="panel-body"><?= $p4['price']?><?= $params['currencyReal']?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card col-lg-3">
            <div class="panel-group">
            <!-- <div class="badge-overlay">
                <span class="top-right badges pink">MVP</span>
            </div> -->
                <div class="ribbon purple"><span>MVP</span></div>
                <div class="panel panel-danger animated-box in">
                    <div class="panel-heading">BET KING</div>
                    <div class="panel-body"><?php echo $kingbet ?></div>
                </div>
            </div>
        </div>
        <div class="card col-lg-3">
            <div class="panel-group">
            <!-- <div class="ribbon blue"><span>TNT</span></div> -->
                <div class="panel panel-success">
                    <div class="panel-heading">BET PROPHET</div>
                    <div class="panel-body"><?php echo $betprophet ?></div>
                </div>
            </div>
        </div>
        <div class="card col-lg-3">
            <div class="panel-group">
                <div class="panel panel-info">
                    <div class="panel-heading">TREND SETTER</div>
                    <div class="panel-body"><?php echo $trendsetter ?></div>
                </div>
            </div>
        </div>
        <div class="card col-lg-3">
            <div class="panel-group">
                <div class="panel panel-warning">
                    <div class="panel-heading">BET RESILENT</div>
                    <div class="panel-body"><?php echo $betresilent ?></div>
                </div>
            </div>
        </div>
        </div>  
    <div class="row">
        <div class="card col-lg-4">
            <div class="panel-group">
                <div class="panel panel-info">
                    <div class="panel-heading">BETMAN</div>
                    <div class="panel-body"><?php echo $betman ?></div>
                </div>
            </div>
        </div>
        <div class="card col-lg-4">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading">SURVIVAL</div>
                    <div class="panel-body"><?php echo $survival ?></div>
                </div>
            </div>
        </div>
        <div class="card col-lg-4">
            <div class="panel-group">
                <div class="panel panel-default">
                    <div class="panel-heading">BANKRUPTCY</div>
                    <div class="panel-body"><?php echo $bankruptcy ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card col-lg-4">
            <div class="card-body border-bottom">
                <?= ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'indexAxis' => 'y',
                        'height' => 60,
                        'width' => 100,
                        'scales' => [
                            'y' => [
                                'beginAtZero' => true,
                                'stacked' => true,
                                'fontSize' => 5,
                            ],
                            'x' => [
                                'stacked' => true,
                                'grid' => [
                                    'borderColor' => 'red',
                                    'offset' => true
                                ]
                            ]
                        ]
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Top 3',
                        ],
                        'legend' => [
                            'display' => false,
                            'position' => 'left',
                            'labels' => [
                                'fontSize' => 11,
                                'fontColor' => "#425062",
                            ]
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'intersect' => true
                        ],
                        'hover' => [
                            'mode' => false
                        ],
                    ],
                    'data' => [
                        'labels' => array_slice($usernames, 0, 3),
                        'datasets' => [
                            [
                                'label' => "Current points",
                                'backgroundColor' => 'rgba(255, 159, 64, 0.8)',
                                'borderColor' => "rgba(255,99,132,1)",
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 4,
                                'pointHoverRadius' => 6,
                                'minBarLength' => 1,
                                'maxBarThickness' => 40,
                                'barThickness' => 30,
                                'barPercentage' => 0.5,
                                'data' => array_slice($total, 0, 3)
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="card col-lg-4">
            <div class="card-body border-bottom">
            <?= ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'height' => 65,
                        'width' => 100,
                        'scales' => [
                            'y' => [
                              'beginAtZero' => true
                            ]
                        ]
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Top 10',
                        ],
                        'legend' => [
                            'display' => false,
                            'position' => 'left',
                            'labels' => [
                                'fontSize' => 11,
                                'fontColor' => "#425062",
                            ]
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'intersect' => true
                        ],
                        'hover' => [
                            'mode' => false
                        ],
                    ],
                    'data' => [
                        'labels' => array_slice($usernames, 0, 10),
                        'datasets' => [
                            [
                                'label' => "Current points",
                                'backgroundColor' => 'rgba(75, 192, 192, 0.8)',
                                'borderColor' => "rgba(255,99,132,1)",
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 4,
                                'pointHoverRadius' => 6,
                                'data' => array_slice($total, 0, 10)
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="card col-lg-4">
            <div class="card-body border-bottom">
            <?= ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'height' => 70,
                        'width' => 100,
                        'scales' => [
                            'y' => [
                              'beginAtZero' => true
                            ]
                        ]
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Top 20',
                        ],
                        'legend' => [
                            'display' => false,
                            'position' => 'left',
                            'labels' => [
                                'fontSize' => 11,
                                'fontColor' => "#425062",
                            ]
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'intersect' => true
                        ],
                        'hover' => [
                            'mode' => false
                        ],
                    ],
                    'data' => [
                        'labels' => array_slice($usernames, 0, 20),
                        'datasets' => [
                            [
                                'label' => "Current points",
                                'backgroundColor' => "rgba(255,99,132,1)",
                                'borderColor' => "rgba(255,99,132,1)",
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 4,
                                'pointHoverRadius' => 6,
                                'data' => array_slice($total, 0, 20)
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="card col-lg-12">
            <div class="card-body border-bottom">
                <?= ChartJs::widget([
                    'type' => 'line',
                    'options' => [
                        'height' => 30,
                        'width' => 100,
                        'scales' => [
                            'y' => [
                                'stacked' => true,
                            ]
                        ]
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Win times/Bet times',
                        ],
                        'legend' => [
                            'display' => true,
                            'position' => 'top',
                            'labels' => [
                                'fontSize' => 15,
                                'fontColor' => "#425062",
                            ]
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'intersect' => true
                        ],
                        'hover' => [
                            'mode' => false
                        ],
                    ],
                    'data' => [
                        'labels' => $usernames,
                        'datasets' => [
                            // 'tension' => 0.5,
                            [
                                'label' => "Bet times",
                                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                                'borderColor' => 'rgba(54, 162, 235, 1)',
                                'pointBackgroundColor' => 'rgba(54, 162, 235, 1)',
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                'pointStyle' => 'circle',
                                'pointRadius' => 4,
                                'pointHoverRadius' => 6,
                                'spanGaps' => true,
                                'data' => $bet_times
                            ],
                            [
                                'label' => "Win times",
                                'backgroundColor' => 'rgba(255, 99, 132, 0.5)',
                                'borderColor' => "rgba(255,99,132,1)",
                                'pointBackgroundColor' => 'rgba(255, 99, 132, 1)',
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 4,
                                'pointHoverRadius' => 6,
                                'spanGaps' => true,
                                'data' => $win_times
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="card col-lg-5">
            <div class="card-body border-bottom">
            <?= ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'height' => 70,
                        'width' => 100,
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Win rates',
                        ],
                        'legend' => [
                            'display' => false,
                            'position' => 'left',
                            'labels' => [
                                'fontSize' => 11,
                                'fontColor' => "#425062",
                            ]
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'intersect' => true
                        ],
                        'hover' => [
                            'mode' => false
                        ],
                    ],
                    'data' => [
                        'labels' => $usernames,
                        'datasets' => [
                            [
                                'label' => "Win rate",
                                'backgroundColor' => 'rgba(255, 99, 132, 0.8)',
                                'borderColor' => 'rgb(255, 99, 132)',
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 4,
                                'pointHoverRadius' => 6,
                                'data' => $win_rates
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="card col-lg-3">
            <div class="card-body border-bottom">
            <?= ChartJs::widget([
                'type' => 'pie',
                'options' => [
                    'height' => 400,
                    'width' => 400
                ],
                'clientOptions' => [
                    'title' => [
                        'display' => false,
                        'text' => 'Win rates',
                    ],
                    'legend' => [
                        'display' => true,
                        'position' => 'left',
                        'labels' => [
                            'fontSize' => 11,
                            'fontColor' => "#425062",
                        ]
                    ],
                    'tooltips' => [
                        'enabled' => true,
                        'intersect' => true
                    ],
                    'hover' => [
                        'mode' => false
                    ],
                ],
                'data' => [
                    'labels' => array_slice($usernames, 0, 10),
                    'datasets' => [
                        [
                            'label' => "My Second dataset",
                            'backgroundColor' => [
                                'rgba(255, 99, 132, 0.5)',
                                'rgba(255, 159, 64, 0.5)',
                                'rgba(255, 205, 86, 0.5)',
                                'rgba(75, 192, 192, 0.5)',
                                'rgba(54, 162, 235, 0.5)',
                                'rgba(153, 102, 255, 0.5)',
                                'rgba(201, 203, 207, 0.5)'
                            ],
                            'borderColor' => [
                                'rgb(255, 99, 132)',
                                'rgb(255, 159, 64)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(54, 162, 235)',
                                'rgb(153, 102, 255)',
                                'rgb(201, 203, 207)'
                            ],
                            'pointBackgroundColor' => "rgba(255,99,132,1)",
                            'pointBorderColor' => "#fff",
                            'pointHoverBackgroundColor' => "#fff",
                            'pointHoverBorderColor' => "rgba(255,99,132,1)",
                            'data' => array_slice($total, 0, 10)
                        ]
                    ]
                ]
            ]);
            ?>
            </div>
        </div>
        <div class="card col-lg-4">
            <div class="card-body border-bottom">
                <?= ChartJs::widget([
                    'type' => 'doughnut',
                    'options' => [
                        'height' => 400,
                        'width' => 400
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => false,
                            'text' => 'Win rates',
                        ],
                        'legend' => [
                            'display' => true,
                            'position' => 'left',
                            'labels' => [
                                'fontSize' => 11,
                                'fontColor' => "#425062",
                            ]
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'intersect' => true
                        ],
                        'hover' => [
                            'mode' => false
                        ],
                        'maintainAspectRatio' => false,
                    ],
                    'data' => [
                        'labels' => array_slice($usernames, 0, 10),
                        'datasets' => [
                            [
                                'label' => "Bet times",
                                'backgroundColor' => [
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(255, 159, 64, 0.5)',
                                    'rgba(255, 205, 86, 0.5)',
                                    'rgba(75, 192, 192, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(153, 102, 255, 0.5)',
                                    'rgba(201, 203, 207, 0.5)'
                                ],
                                'borderColor' => [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ],
                                'pointBackgroundColor' => "rgba(179,181,198,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                'pointStyle' => 'circle',
                                'pointRadius' => 4,
                                'pointHoverRadius' => 6,
                                'data' => array_slice($bet_times, 0, 10)
                            ],
                            [
                                'label' => "Win times",
                                'borderWidth' => 1,
                                'backgroundColor' => [
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(255, 159, 64, 0.5)',
                                    'rgba(255, 205, 86, 0.5)',
                                    'rgba(75, 192, 192, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(153, 102, 255, 0.5)',
                                    'rgba(201, 203, 207, 0.5)'
                                ],
                                'borderColor' => [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ],
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 4,
                                'pointHoverRadius' => 6,
                                'hoverOffset' => 5,
                                'data' => array_slice($win_times, 0, 10)
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body border-bottom">
            <?= ChartJs::widget([
                        'type' => 'bar',
                        'options' => [
                            'responsive' => false,
                            'maintainAspectRatio' => true,
                            'height' => 30,
                            'width' => 100,
                            'scales' => [
                                'y' => [
                                    'stacked' => false,
                                ],
                                'x' => [
                                    'stacked' => false,
                                ]
                            ]
                        ],
                        'clientOptions' => [
                            'title' => [
                                'display' => true,
                                'text' => 'Win times/Bet times',
                            ],
                            'legend' => [
                                'display' => true,
                                'position' => 'top',
                                'labels' => [
                                    'fontSize' => 15,
                                    'fontColor' => "#425062",
                                ]
                            ],
                            'tooltips' => [
                                'enabled' => true,
                                'intersect' => true
                            ],
                            'hover' => [
                                'mode' => false
                            ],
                        ],
                        'data' => [
                            'labels' => $usernames,
                            'datasets' => [
                                // 'tension' => 0.5,
                                [
                                    'label' => "Total",
                                    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                                    'borderColor' => 'rgba(54, 162, 235, 1)',
                                    'pointBackgroundColor' => 'rgba(54, 162, 235, 1)',
                                    'pointBorderColor' => "#fff",
                                    'pointHoverBackgroundColor' => "#fff",
                                    'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                    'pointStyle' => 'circle',
                                    'pointRadius' => 4,
                                    'pointHoverRadius' => 6,
                                    'spanGaps' => true,
                                    'data' => $total
                                ],
                                [
                                    'label' => "Available",
                                    'backgroundColor' => 'rgba(255, 99, 132, 0.5)',
                                    'borderColor' => "rgba(255,99,132,1)",
                                    'pointBackgroundColor' => 'rgba(255, 99, 132, 1)',
                                    'pointBorderColor' => "#fff",
                                    'pointHoverBackgroundColor' => "#fff",
                                    'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                    'pointRadius' => 4,
                                    'pointHoverRadius' => 6,
                                    'spanGaps' => true,
                                    'data' => $available
                                ]
                            ]
                        ]
                    ]);
                    ?>
                </div>
        </div>
    </div>
    <div class="row">
        <div class="card col-lg-4">
        </div>
        <div class="card col-lg-4">
        <div class="card-body border-bottom">
            <?= ChartJs::widget([
                    'type' => 'radar',
                    'options' => [
                        'height' => 70,
                        'width' => 100,
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Win rates',
                        ],
                        'legend' => [
                            'display' => false,
                            'position' => 'left',
                            'labels' => [
                                'fontSize' => 11,
                                'fontColor' => "#425062",
                            ]
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'intersect' => true
                        ],
                        'hover' => [
                            'mode' => false
                        ],
                    ],
                    'data' => [
                        'labels' => $usernames,
                        'datasets' => [
                            [
                                'label' => "Win rate",
                                'backgroundColor' => 'rgba(255, 99, 132, 0.8)',
                                'borderColor' => 'rgb(255, 99, 132)',
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 4,
                                'pointHoverRadius' => 6,
                                'data' => $win_rates
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
        <div class="card col-lg-4">
            <div class="card-body border-bottom">
            <?= ChartJs::widget([
                    'type' => 'polarArea',
                    'options' => [
                        'indexAxis' => 'y',
                        'height' => 60,
                        'width' => 100,
                        'scales' => [
                            'y' => [
                                'beginAtZero' => true,
                                'stacked' => true,
                                'fontSize' => 5,
                            ],
                            'x' => [
                                'stacked' => true,
                                'grid' => [
                                    'borderColor' => 'red',
                                    'offset' => true
                                ]
                            ]
                        ]
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Top 3',
                        ],
                        'legend' => [
                            'display' => false,
                            'position' => 'left',
                            'labels' => [
                                'fontSize' => 11,
                                'fontColor' => "#425062",
                            ]
                        ],
                        'tooltips' => [
                            'enabled' => true,
                            'intersect' => true
                        ],
                        'hover' => [
                            'mode' => false
                        ],
                    ],
                    'data' => [
                        'labels' => array_slice($usernames, 0, 10),
                        'datasets' => [
                            [
                                'label' => "Win times",
                                'borderWidth' => 1,
                                'backgroundColor' => [
                                    'rgba(255, 99, 132, 0.5)',
                                    'rgba(255, 159, 64, 0.5)',
                                    'rgba(255, 205, 86, 0.5)',
                                    'rgba(75, 192, 192, 0.5)',
                                    'rgba(54, 162, 235, 0.5)',
                                    'rgba(153, 102, 255, 0.5)',
                                    'rgba(201, 203, 207, 0.5)'
                                ],
                                'borderColor' => [
                                    'rgb(255, 99, 132)',
                                    'rgb(255, 159, 64)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(54, 162, 235)',
                                    'rgb(153, 102, 255)',
                                    'rgb(201, 203, 207)'
                                ],
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 4,
                                'pointHoverRadius' => 6,
                                'hoverOffset' => 5,
                                'data' => array_slice($win_times, 0, 10)
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
