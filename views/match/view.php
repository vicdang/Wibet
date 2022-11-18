<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Match $model
 */
$this->title = $model->getMatchTitle();
$this->params['breadcrumbs'][] = ['label' => 'Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-view">

    <h1><?= $model->getMatchName(); ?></h1>

    <?php if (Yii::$app->user->can('admin') && $model->canDelete()): ?>
    <p>
        <?= $model->canUpdate() ? Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) : '' ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php endif; ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
	    ['label' => "Team 1",
	     'value' => $model->team1->full_name,
	    ],
     	    ['label' => "Team 2",
             'value' => $model->team2->full_name,
            ],
            //'team1.full_name',
            //'team2.full_name',
            'team_1_score',
            'team_2_score',
            'rate',
            [
                'label' => "Result",
                'format' => 'raw',
                'value' => function($model){
                    switch ($model['result']) {
                        case 0:
                            return '<span class="badge badge-pill badge-success">DRAW</span>';
                        case 1:
                            return $model['team1']['full_name'];
                        case 2:
                            return $model['team2']['full_name'];
                        case 3:
                            return '<span class="badge badge-pill badge-secondary">&nbsp;Canceled&nbsp;</span>';

                    }
                }
            ],
            'match_date',
            'description:ntext',
            //'created_by',
            'created_time',
            'modified_time',
        ],
    ]) ?>

</div>
