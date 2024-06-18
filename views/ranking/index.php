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
        // 'filterModel' => $searchModel,
        'emptyText' => '-',
		'showFooter' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            [
                'attribute' => 'username',
                'label' => 'User',
            ],
            // [
            //     'attribute' => 'email',
            //     'label' => 'Email',
            // ],
            // [
            //     'attribute' => 'full_name',
            //     'label' => 'Name',
            // ],
            [
                'attribute' => 'total_money',
                'label' => 'Total',
            ],
            [
                'attribute' => 'bet_money',
                'label' => 'Placed',
            ],
            [
                'attribute' => 'money',
                'label' => 'Available',
            ],
            [
                'attribute' => 'bet_times',
                'label' => 'Bet',
            ],
            [
                'attribute' => 'win_times',
                'label' => 'Win',
            ],
            [
                'attribute' => 'win_rate',
                'label' => 'Rate',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => $hide_history == 0 ? '{view}' : "",
                'buttons' => [
                    'view' => function ($url, $model) {
                            // return Html::a('<span class="glyphicon glyphicon-share-alt"></span>', array('/ranking/view', 'username' => $model['username']));
                            return Html::a('<span class="glyphicon glyphicon-share-alt"></span>', array('/ranking/view', 'username' => $model['username']), [
                                'title' => 'View info',
                                'data-id' => $model['username'],
                                'class' => 'btn btn-primary',
                            ]);
                        },
                ]
            ],
        ],
    ]); 
    ?>



</div>
