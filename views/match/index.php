<?php

use app\assets\Helper;
use yii\helpers\Html;
use yii\grid\GridView;
use \app\models\Bet;
/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 * @var app\models\MatchSearch $searchModel
 */

$this->title = 'Matches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="match-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (Yii::$app->user->can('admin')) : ?>
    <p class="btn-container">
        <?= Html::a('Create Match', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'team_1',
                'filter' => false,
                'label' => 'Team 1',
                'headerOptions' => [
                    'width' => '200'
                ],
    		'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                        return "<img src='".$model->team1->flag."' /> " . $model->team1->full_name;
                    }
            ],
            //'team1.full_name',
            [
                'attribute' => 'team_2_score',
                'filter' => false,
                'label' => '-',
                'headerOptions' => [
                    'width' => '50'
                ],
                'value' => function($model, $index, $dataColumn) {
                        return is_null($model->team_1_score) ? "?" : $model->team_1_score;
                    }
            ],
            [
                'attribute' => 'team_2_score',
                'filter' => false,
                'label' => '-',
                'headerOptions' => [
                    'width' => '50'
                ],
                'value' => function($model, $index, $dataColumn) {
                        return is_null($model->team_2_score) ? "?" : $model->team_2_score;
                    }
            ],
   	    [
                'attribute' => 'team_2',
                'filter' => false,
                'label' => 'Team 2',
                'headerOptions' => [
                    'width' => '200'
                ],
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                        return "<img src='".$model->team2->flag."' /> " . $model->team2->full_name;
                    }
            ],
            //'team2.full_name',
            [
                'attribute' => 'match_date',
                'headerOptions' => [
                    'width' => '220'
                ],
                'value' => function($model, $index, $dataColumn) {
                        return Helper::printDatetime($model->match_date, "%b %d, %Y %I:%M %p");
                    }
            ],
            [
                'attribute' => 'rate',
                'headerOptions' => [
                    'width' => '100'
                ],
                'value' => function($model, $index, $dataColumn) {
                    return $model->getRateText();
                }
            ],
            [
                'label' => 'Result after rate',
                'headerOptions' => [
                    'width' => 'auto'
                ],
                'value' => function($model, $index, $dataColumn) {
		    if($model->getAfterRateResult())
                       return $model->team1->name . " - " . $model->getAfterRateResult() . " - " . $model->team2->name;
                }
                //'visible' => !is_null($model->result)
            ],
            'description:ntext',
            [
                'label' => 'Your Bet',
                'format' => 'raw',
                'headerOptions' => [
                    'width' => '150'
                ],
                'value' => function($model, $index, $dataColumn) {
                        $bet = Bet::isExist(Yii::$app->user->id, $model->id);
                        if ($bet)
                            return $bet->getBettingOption() .' <span class="badge badge-pill badge-warning">'. $bet->money . 'p</span>' .
                            ( $model->canBet() ?
                                Html::a("<span class='glyphicon glyphicon-edit'></span>", ['bet/update', 'id' => $bet->id]) .
                                Html::a("<span class='glyphicon glyphicon-remove'></span>", ['bet/delete', 'id' => $bet->id], ['data' => ['confirm' => 'Are you sure you want to delete this bet?', 'method'=>'post']])
                                : '' );
                        elseif ($model->canBet())
                            return Html::a('<span class="badge badge-pill badge-success">Bet Now</span>', ['bet/create', 'match_id' => $model->id]);
                        else
                            return '-';
                    }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Yii::$app->user->can('admin') ? '{history} {update} {delete}' : ($hide_history == 0 ? '{history}' : ""),
                'buttons' => [
                    'history' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-expand"></span>', array('/bet/view', 'match_id' => $model->id), [
                                'title' => Yii::t('app', 'View All Bets'),
                            ]);
                        },
                    'update' => function ($url, $model) {
                            if ($model->canUpdate())
                                return Html::a('<span class="glyphicon glyphicon-edit"></span>', $url, [
                                    'title' => Yii::t('app', 'Update'),
                                ]) . ' ' . Html::a('<span class="glyphicon glyphicon-ok-sign"></span>', ['update-score', 'id' => $model->id], [
                                    'title' => Yii::t('app', 'Update Score'),
                                ]);
                            else
                                return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', array('view', 'id' => $model->id), [
                                    'title' => Yii::t('app', 'View'),
                                ]);
                        },
                    'delete' => function ($url, $model) {
                            if ($model->canDelete())
                                return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                    'title' => Yii::t('app', 'Delete'),
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this match ?',
                                        'method' => 'post'
                                    ]
                                ]);
                            return '';
                        }
                ],

                'headerOptions' => [
                    'width' => Yii::$app->user->can('admin') ? '150' : '40'
                ],
                //'visible' => Yii::$app->user->can('admin')
            ],
        ],
    ]); ?>
</div>
