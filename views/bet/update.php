<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 */

$this->title = 'Update Bet: ' . $model->match->getMatchName();
$this->params['breadcrumbs'][] = ['label' => $model->match->getMatchName(), 'url' => ['/match/view', 'id' => $model->match_id]];
$this->params['breadcrumbs'][] = 'Update Bet';
?>
<div class="bet-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'match' => $model->match
    ]) ?>

</div>
