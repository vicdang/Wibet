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
$params = Yii::$app->params;
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
            [
                'attribute' => 'full_name',
                'label' => 'Name',
            ],
            [
                // 'attribute' => 'total_money',
                'label' => 'Total',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model['total_money'] != NULL){
                        if($model['total_money'] <= 0){
                            return '<span class="badge badge-pill badge-danger">'.$model['total_money'].'</span>';
                        } else {
                            return '<span class="badge badge-pill badge-success">'.$model['total_money'].'</span>';
                        }
                    }
                }
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
                // 'attribute' => 'bet_times',
                'label' => 'Bet',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model['bet_times'] != NULL){
                        if($model['bet_times'] < Yii::$app->params['minBetTimes']){
                            return '<span class="badge badge-pill badge-danger">'.$model['bet_times'].'</span>';
                        } else {
                            return '<span class="badge badge-pill badge-success">'.$model['bet_times'].'</span>';
                        }
                    }
                }
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
