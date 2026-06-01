<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\Helper;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\BetSearch $searchModel
 */

$this->title = 'Predictions';
?>
<div class="bet-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="btn-container">
        <?= Html::a('Create Prediction', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'emptyText' => '-',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'user_id',
            'match_id',
            'option',
            [
                'attribute' => 'money',
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                    return Helper::formatMoney($model->money);
                }
            ],
            'created_time',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
