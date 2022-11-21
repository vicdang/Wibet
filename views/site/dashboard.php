<?php
use yii\helpers\Html;
use sjaakp\gcharts\PieChart;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\BetSearch $searchModel
 */
$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container">
    <h1 class="err-title"><?= Html::encode($this->title) ?></h1>
    <?php
        PieChart::widget([
            'height' => '400px',
            'dataProvider' => $dataProvider,
            'columns' => [
                'name:string',
                'population'
            ],
            'options' => [
                'title' => 'Countries by Population'
            ],
        ])
    ?>
</div>

