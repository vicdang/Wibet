<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 * @var app\models\Match $match
 */

$this->title = $match->getMatchName() . " / " . "View All Bets";
$this->params['breadcrumbs'][] = ['label' => 'Matches', 'url' => ['/match/index']];
$this->params['breadcrumbs'][] = ['label' => $match->getMatchName(), 'url' => ['/match/view', 'id' => $match->id]];
$this->params['breadcrumbs'][] = "View All Bets";
?>
<div class="bet-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'label' => 'Username',
                'value' => function($model, $index, $dataColumn) {
                        return $model->user->username;
                    }
            ],
            [
                'label' => 'Email',
                'value' => function($model, $index, $dataColumn) {
                        return $model->user->email;
                    }
            ],
            [
                'attribute' => 'option',
                'value' => function($model, $index, $dataColumn) {
                        return $model->getBettingOption();
                    }
            ],
            'money',
            [
                'attribute' => 'created_time',
                'label' => 'Bet Time',
                'headerOptions' => [
                    'width' => '170',
                ],
                'value' => function($model, $index, $dataColumn) {
                        return Helper::printDatetime($model->created_time, "%b %d, %Y %I:%M %p");
                    }
            ],
            [
                'label' => 'Result',
                'value' => function($model, $index, $dataColumn) {
                        return $model->getBettedResult();
                    },
                'visible' => !is_null($match->result)
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'headerOptions' => [
                    'width' => '25'
                ],
                'visible' => Yii::$app->user->can('admin')
            ],
        ],
    ]); ?>

</div>