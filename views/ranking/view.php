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

    <h4><?= Html::encode($this->title) ?></h4>
    <h1> <?= $user->username ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'team_1',
            'team_2',
            'rate',
            //'result',
	    //'option',
            'money',
      	    [
                'label' => 'Bet result',
                'value' => function ($model) {
                    return $model['result'] == $model['option'] ? "win" : "lose";
                }
            ],
        ],
    ]);
    ?>



</div>
