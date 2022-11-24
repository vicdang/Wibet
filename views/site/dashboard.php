<?php
use yii\helpers\Html;
use practically\chartjs\Chart;
use dosamigos\chartjs\ChartJs;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\BetSearch $searchModel
 */
$this->title = 'Dashboard';
?>
<div class="container">
    <h1 class="err-title"><?= Html::encode($this->title) ?></h1>
    <div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body border-bottom">
                <h4 class="card-title mb-4"><?= $this->title ?></h4>
                <?= ChartJs::widget([
                    'type' => 'line',
                    'options' => [
                        'height' => 400,
                        'width' => 400
                    ],
                    'data' => [
                        'labels' => ["January", "February", "March", "April", "May", "June", "July"],
                        'datasets' => [
                            [
                                'label' => "My First dataset",
                                'backgroundColor' => "rgba(179,181,198,0.2)",
                                'borderColor' => "rgba(179,181,198,1)",
                                'pointBackgroundColor' => "rgba(179,181,198,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(179,181,198,1)",
                                'data' => [65, 59, 90, 81, 56, 55, 40]
                            ],
                            [
                                'label' => "My Second dataset",
                                'backgroundColor' => "rgba(255,99,132,0.2)",
                                'borderColor' => "rgba(255,99,132,1)",
                                'pointBackgroundColor' => "rgba(255,99,132,1)",
                                'pointBorderColor' => "#fff",
                                'pointHoverBackgroundColor' => "#fff",
                                'pointHoverBorderColor' => "rgba(255,99,132,1)",
                                'data' => [28, 48, 40, 19, 96, 27, 100]
                            ]
                        ]
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
</div>

