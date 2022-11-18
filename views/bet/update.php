<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 */

$this->title = $model->match->getMatchTitle();
$this->params['breadcrumbs'][] = ['label' => $model->match->getMatchTitle(), 'url' => ['/match/view', 'id' => $model->match_id]];
$this->params['breadcrumbs'][] = 'Update Bet';
?>
<div class="bet-update">
    <h2>Update bet</h2>
    <h1><?= $model->match->getMatchName() ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'match' => $model->match
    ]) ?>

</div>
