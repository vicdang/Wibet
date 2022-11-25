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
    $bet_times = array();
    $win_times = array();
    $usernames = array();
    $win_rates = array();
    $total = array();
    foreach ($rankingDataProvider->getModels() as $key => $value) {
        // print_r($value);
        array_push($win_times, $value['win_times']);
        array_push($usernames, $value['username']);
        array_push($bet_times, $value['bet_times']);
        array_push($win_rates, $value['win_rate']);
        array_push($total, $value['total_money']);
    }
?>
<!-- <span>
<?php
    foreach ($matchDataProvider->getModels() as $key => $value) {
        print_r($value);
    }
?>
</span> -->
    <div>
        <div class="card col-lg-12">
            <div class="card-body border-bottom">
                <?= ChartJs::widget([
                    'type' => 'line',
                    'options' => [
                        'height' => 30,
                        'width' => 100
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Win/Bet',
                        ],
                        'legend' => [
                            'display' => true,
                            'position' => 'bottom',
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
                                'label' => "Bet times",
                                'backgroundColor' => "rgba(179,181,198,0.2)",
                                'borderColor' => "rgba(179,181,198,1)",
                                'pointBackgroundColor' => "rgba(179,181,198,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                'pointStyle' => 'circle',
                                'pointRadius' => 5,
                                'pointHoverRadius' => 10,
                                'data' => $bet_times
                            ],
                            [
                                'label' => "Win times",
                                'backgroundColor' => "rgba(255,99,132,0.2)",
                                'borderColor' => "rgba(255,99,132,1)",
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 5,
                                'pointHoverRadius' => 10,
                                'data' => $win_times
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <div>
        <div class="card col-lg-4">
            <div class="card-body border-bottom">
            <?= ChartJs::widget([
                    'type' => 'bar',
                    'options' => [
                        'height' => 50,
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
                            'position' => 'bottom',
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
                                'backgroundColor' => "rgba(255,99,132,1)",
                                'borderColor' => "rgba(255,99,132,1)",
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 5,
                                'pointHoverRadius' => 10,
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
                        'height' => 55,
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
                            'position' => 'bottom',
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
                                'pointRadius' => 5,
                                'pointHoverRadius' => 10,
                                'data' => array_slice($total, 0, 20)
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
                        'height' => 60,
                        'width' => 100
                    ],
                    'clientOptions' => [
                        'title' => [
                            'display' => true,
                            'text' => 'Win rates',
                        ],
                        'legend' => [
                            'display' => false,
                            'position' => 'bottom',
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
                                'backgroundColor' => "rgba(255,99,132,1)",
                                'borderColor' => "rgba(255,99,132,1)",
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 5,
                                'pointHoverRadius' => 10,
                                'data' => $win_rates
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <div>
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
                        'position' => 'bottom',
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
                            'backgroundColor' => "rgba(255,99,132,0.2)",
                            'borderColor' => "rgba(255,99,132,1)",
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
        <div class="card col-lg-3">
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
                            'position' => 'bottom',
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
                                'label' => "Bet times",
                                'backgroundColor' => "rgba(179,181,198,0.2)",
                                'borderColor' => "rgba(179,181,198,1)",
                                'pointBackgroundColor' => "rgba(179,181,198,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                'pointStyle' => 'circle',
                                'pointRadius' => 5,
                                'pointHoverRadius' => 10,
                                'data' => array_slice($bet_times, 0, 10)
                            ],
                            [
                                'label' => "Win times",
                                'backgroundColor' => "rgba(255,99,132,0.2)",
                                'borderColor' => "rgba(255,99,132,1)",
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'pointRadius' => 5,
                                'pointHoverRadius' => 10,
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

