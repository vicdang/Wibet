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
                'label' => '-',
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
                'label' => '-',
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
                // 'headerOptions' => [
                //     'width' => '100'
                // ],
                'value' => function($model, $index, $dataColumn) {
                    return $model->getRateText();
                }
            ],  
            [
                'attribute' => 'match_date',
                'filter' => false,
                'value' => function($model, $index, $dataColumn) {
                        return Helper::printDatetime($model->match_date, "%b %d, %Y %I:%M %p");
                    }
            ],
            [
                'label' => 'After Rate',
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                    if($model->result == 3){
                        return '<span class="badge badge-pill badge-secondary">&nbsp;Canceled&nbsp;</span>';
                    }
		            if($model->getAfterRateResult())
                       return $model->team1->name . " [" . $model->getAfterRateResult() . "] " . $model->team2->name;
                    else
                        return '-';
                    }
                //'visible' => !is_null($model->result)
            ],
            [
                'label' => 'Your Bet',
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                        $bet = Bet::isExist(Yii::$app->user->id, $model->id);
                        if ($bet)
                            return $bet->getBettingOption() .' <span class="badge badge-pill badge-warning">'. $bet->money . 'p</span>' .
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
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', array('/bet/view', 'match_id' => $model->id), [
                                'title' => Yii::t('app', 'View All Bets'),
                            ]);
                        },
                    'update' => function ($url, $model) {
                            if ($model->canUpdate())
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                    'title' => Yii::t('app', 'Update'),
                                ]) . ' ' . Html::a('<span class="glyphicon glyphicon-ok-sign"></span>', ['update-score', 'id' => $model->id], [
                                    'title' => Yii::t('app', 'Update Score'),
                                ]);
                            else
                                return Html::a('<span class="glyphicon glyphicon-info-sign"></span>', array('view', 'id' => $model->id), [
                                    'title' => Yii::t('app', 'View Detail'),
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
            [
                'attribute' => 'Action',
                'format' => 'raw',
                'value' => function($model, $index, $dataColumn) {
                    $btn_cancel = '<button class="btn btn-danger btn-cancel" data-id="'.$model->id.'">Cancel</button> ';
                    if ($model->visible == 1) {
                        $btn_visible =  '<a href="/match/set-visible?value=0&id='.$model->id.'" class="btn btn-hide btn-visible" data-id="'.$model->id.'">Hide</a> ';
                    }else{
                        $btn_visible =  '<a href="/match/set-visible?value=1&id='.$model->id.'" class="btn btn-show btn-visible" data-id="'.$model->id.'">Show</a> ';
                    }
                    //return $model->visible;
                    if($model->result === NULL){
                        return $btn_cancel . $btn_visible;
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
