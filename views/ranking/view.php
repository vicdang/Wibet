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
            // 'team_1_name',
            // 'team_2_name',
            [
                'label' => 'Match',
                'format' => 'raw',
                'value' => function ($model) {
                    $team_1 = $model['result'] == 0 ? '<span class="badge badge-pill badge-warning">'.$model['team_1_name'].'</span>' : 
                    ($model['result'] == 1 ? '<span class="badge badge-pill badge-success">'.$model['team_1_name'].'</span>' :
                     '<span class="badge badge-pill badge-danger">'.$model['team_1_name']."</span>") ;
                    $team_2 = $model['result'] == 0 ? '<span class="badge badge-pill badge-warning">'.$model['team_2_name'].'</span>' : 
                    ($model['result'] == 2 ? '<span class="badge badge-pill badge-success">'.$model['team_2_name'].'</span>' :
                     '<span class="badge badge-pill badge-danger">'.$model['team_2_name']."</span>") ;
                    return $team_1 . ' - ' . $team_2;
                }
            ],
            'rate',
	        [
                'label' => 'Option',
                'value' => function ($model) {
                    return  $model['option'] == 1 ? $model['team_1_name'] : $model['team_2_name'];
                }
            ],
            [
                'label' => 'Placed',
                'attribute' => 'money'
            ],
            // 'money',
      	    [
                'label' => 'Bet result',
                'format' => 'raw',
                'value' => function ($model) {
                    if($model['result'] != NULL){
                        if($model['result'] == $model['option']){
                            return '<span class="badge badge-pill badge-success">W <span class="glyphicon glyphicon-triangle-top"></span></span>';
                        }else{
                            if($model['result'] == 0){
                                return '<span class="badge badge-pill badge-warning">D <span class="glyphicon glyphicon-minus"></span></span>';
                            }else if($model['result'] == 3){
                                return '<span class="badge badge-pill badge-secondary">C <span class="glyphicon glyphicon-remove"></span></span>';
                            }else{
                                return '<span class="badge badge-pill badge-danger">L <span class="glyphicon glyphicon-triangle-bottom"></span></span>';
                            }
                        }
                    }else{
                        return '-';
                    }
                },
            ],
        ],
    ]);
    ?>
</div>
