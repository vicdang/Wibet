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

    <!-- <?php echo $this->render('_search', ['model' => $searchModel]); ?> -->
    <?php if (Yii::$app->user->can('admin')) : ?>
    <p class="btn-container">
        <?= Html::a('Create Match', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?php endif; ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'team_1',
                'filter' => false,
                'label' => 'Team 1',
                // 'headerOptions' => [
                //     'width' => '200'
                // ],
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                        return '<div class="image-cropper team-name"><img alt="avatar" class="profile-pic" src="'.$model->team1->flag.'" /></div><h5>' . $model->team1->full_name . '</h5>';
                    }
            ],
                //'team1.full_name',
                
            [
                'attribute' => 'team_1_score',
                'filter' => false,
                'label' => ' - ',
                // 'headerOptions' => [
                //     'width' => '50'
                // ],
                'value' => function($model, $index, $dataColumn) {
                        return is_null($model->team_1_score) ? "-" : $model->team_1_score;
                    }
            ],
            [
                'attribute' => 'team_2_score',
                'filter' => false,
                'label' => ' - ',
                // 'headerOptions' => [
                //     'width' => '50'
                // ],
                'value' => function($model, $index, $dataColumn) {
                        return is_null($model->team_2_score) ? "-" : $model->team_2_score;
                    }
            ],
            [
                'attribute' => 'team_2',
                'filter' => false,
                'label' => 'Team 2',
                // 'headerOptions' => [
                //     'width' => '200'
                // ],
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                    return '<div class="image-cropper team-name"><img alt="avatar" class="profile-pic" src="'.$model->team2->flag.'" /></div><h5>' . $model->team2->full_name . '</h5>';
                    }
            ],
            //'team2.full_name',
            [
                'attribute' => 'rate',
                'label' => 'Handicap',
                // 'headerOptions' => [
                //     'width' => '100'
                // ],
                'value' => function($model, $index, $dataColumn) {
                    return $model->getRateText();
                }
            ],  
            [
                'attribute' => 'match_date',
                'label' => 'Date',
                'filter' => false,
                'value' => function($model, $index, $dataColumn) {
                        return Helper::printDatetime($model->match_date, "%a, %b %d %H:%M");
                        // return Helper::printDatetime($model->match_date, "%m/%d %H:%M");
                    }
            ],
            [
                // 'label' => 'After Rate',
                'label' => 'Result',
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                    if($model->result == 3){
                        return '<span class="badge badge-pill badge-secondary"><span class="glyphicon glyphicon-remove"></span></span>';
                    }
		            if($model->getAfterRateResult())
                       return $model->team1->name . " [" . $model->getAfterRateResult() . "] " . $model->team2->name;
                    else
                        return '-';
                    }
                //'visible' => !is_null($model->result)
            ],
            [
                'label' => 'Rate',
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                    $team_1 =$model->getBetMoneyByTeam(1);
                    $team_2 =$model->getBetMoneyByTeam(2);
                    if (!$model->getBetMoneyByTeam(1)) {
                        $team_1 = 0;
                    }
                    if (!$model->getBetMoneyByTeam(2)) {
                        $team_2 = 0;
                    }
                    return  $team_1 . " / " .$team_2;
                }
                //'visible' => !is_null($model->result)
            ],
            [
                'label' => 'Bet',
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                        $bet = Bet::isExist(Yii::$app->user->id, $model->id);
                        if ($bet)
                            return '<span class="badge badge-pill badge-success"><b>'.$bet->getBettingOption(). '</b></span>' .' <span class="badge badge-pill badge-warning">'. $bet->money . 'p</span>' .
                            ( $model->canBet() ? ' | <span class="badge badge-pill badge-warning">' .
                                Html::a("<span class='glyphicon glyphicon-pencil'></span>", ['bet/update', 'id' => $bet->id]) . ' ' .
                                Html::a("<span class='glyphicon glyphicon-remove'></span>", ['bet/delete', 'id' => $bet->id], ['data' => ['confirm' => 'Are you sure you want to delete this bet?', 'method'=>'post']])
                                . '</span>' : '' );
                        elseif ($model->canBet())
                            return Html::a('<span class="badge badge-pill badge-success">Bet Now <span class="glyphicon glyphicon-share-alt"></span></span>', ['bet/create', 'match_id' => $model->id]);
                        else
                            return '-';
                    }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => Yii::$app->user->can('admin') ? '{history} {update} {delete}' : ($hide_history == 0 ? '{history}' : ''),
                'buttons' => [
                    'history' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-share-alt"></span>', array('/bet/view', 'match_id' => $model->id), [
                                'title' => Yii::t('app', 'View All Bets'),
                                'class' => 'btn btn-primary',
                            ]);
                        },
                    'update' => function ($url, $model) {
                            if ($model->canUpdate())
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('app', 'Update info'),
                                    'class' => 'btn btn-warning',
                                ]) . ' ' . Html::a('<span class="glyphicon glyphicon-ok"></span>', ['update-score', 'id' => $model->id], [
                                    'title' => Yii::t('app', 'Update Score'),
                                    'class' => 'btn btn-success',
                                ]);
                            else
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [
                                    'title' => Yii::t('app', 'Update info'),
                                    'disabled' => true,
                                    'class' => 'btn btn-warning',
                                ]) . ' ' . Html::a('<span class="glyphicon glyphicon-stats"></span>', array('view', 'id' => $model->id), [
                                    'title' => Yii::t('app', 'View Detail'),
                                    'class' => 'btn btn-info',
                                ]);
                        },
                    'delete' => function ($url, $model) {
                            $disabled = true;
                            if ($model->canDelete())
                                $disabled = false;    
                            return Html::a('<span class="glyphicon glyphicon-remove"></span>', $url, [
                                'title' => Yii::t('app', 'Delete this match'),
                                'class' => 'btn btn-danger',
                                'disabled' => $disabled,
                                'data' => [
                                    'confirm' => 'Are you sure you want to DELETE this match ?',
                                    'method' => 'post'
                                ]
                            ]);
                        }
                ],
                'header' => '',
                'headerOptions' => [
                    'width' => Yii::$app->user->can('admin') ? '150' : '40'
                ],
                // 'visible' => Yii::$app->user->can('admin')
            ],
            [
                'attribute' => 'Actions',
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                    // $btn_cancel = '<button class="btn btn-danger btn-cancel" data-id="'.$model->id.'">Cancel</button> ';
                    $btn_cancel = Html::a('<span class="glyphicon glyphicon-off"></span>', '/match/cancel?id='.$model->id, [
                        'title' => 'Withdraw this match',
                        'data-id' => $model->id,
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'This action will affect all related bets !!! Are you sure you want to WITHDRAW this match ?',
                        ]
                    ]);
                    if ($model->visible == 1) {
                        // $btn_visible =  '<a href="/match/set-visible?value=0&id='.$model->id.'" class="btn btn-primary" data-id="'.$model->id.'">Hide</a> ';
                        $btn_visible = Html::a('<span class="glyphicon glyphicon-eye-close"></span>', '/match/set-visible?value=0&id='.$model->id, [
                                        'title' => 'Hide this match',
                                        'data-id' => $model->id,
                                        'class' => 'btn btn-warning',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to HIDE this match ?',
                                        ]
                                    ]);
                    }else{
                        // $btn_visible =  '<a href="/match/set-visible?value=1&id='.$model->id.'" class="btn btn-info" data-id="'.$model->id.'">Show</a> ';
                        $btn_visible = Html::a('<span class="glyphicon glyphicon-eye-open btn-hide"></span>', '/match/set-visible?value=1&id='.$model->id, [
                            'title' => 'Show this match',
                            'data-id' => $model->id,
                            'class' => 'btn btn-info',
                            'data' => [
                                'confirm' => 'Are you sure you want to SHOW this match ?',
                            ]
                        ]);
                    }
                    //return $model->visible;
                    if($model->result === NULL){
                        return $btn_visible . " " . $btn_cancel;
                    }
                    else{
                        return $btn_visible;
                    }
                    
                },
                'visible' => Yii::$app->user->can('admin')
            ], 
        ],
    ]); ?>
</div>

<!-- .modal -->
<div class="modal-cus bg-shadow " id="cancel-popup">
    <div class="modal-dialog">
        <div class="modal-content">
    <!-- <form action="" method="get"> -->
            <div class="modal-header">
                <button type="button" class="close btn-close" data-dismiss="modal">&times;</button> 
                <h4 class="modal-title">Notification</h4>                                                             
            </div> 
            <div class="modal-body">
            Are you sure you want to cancel the match?
            </div>   
            <!-- <input type="hidden" name="result" value="3"> -->
            <div class="modal-footer">
                <a href="" class="btn btn-primary btn-do-cancel" >Confirm</a> 
                <button type="button" class="btn btn-default btn-close" data-dismiss="modal">Close</button> 
            </div>
    <!-- </form> -->
        </div>                                                                       
    </div>                                          
</div>
<!-- 
<script type="text/javascript" src="/js/jquery-1.8.0.js" 0="yii\web\JqueryAsset"></script>
<script type="text/javascript" src="/js/jquery.min.js" 0="yii\web\JqueryAsset"></script>
<script type="text/javascript" src="/js/bootstrap.min.js" 0="yii\web\JqueryAsset"></script>
<script  type="text/javascript" src="/js/bootstrap.js" 0="yii\web\JqueryAsset"></script> -->
