<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\BetSearch $searchModel
 */

$this->title = 'Ranking';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bet-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            [
                'attribute' => 'username',
                'label' => 'User',
            ],
            [
                'attribute' => 'email',
                'label' => 'Email',
            ],
            [
                'attribute' => 'full_name',
                'label' => 'Name',
            ],
            'money',
            'bet_times',
            'win_times',
            'bet_money',
            'win_rate',
            [
                'attribute' => 'total_money',
                'label' => 'Total',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $hide_history == 0 ? '{view}' : "",
                'buttons' => [
                    'view' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', array('/ranking/view', 'username' => $model['username']));
                        },
                ]
            ],
        ],
    ]); 
    ?>



</div>
