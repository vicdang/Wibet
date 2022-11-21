<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 * @var app\models\Match $match
 */
$this->title =  $match->getMatchTitle();
$this->params['breadcrumbs'][] = ['label' => $match->getMatchTitle(), 'url' => ['/match/view', 'id' => $match->id]];
$this->params['breadcrumbs'][] = 'Create Bet';
?>
<div class="bet-create">
    <h2>Create bet</h2>
    <h1><?=  $match->getMatchName() ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'match' => $match
    ]) ?>

</div>
