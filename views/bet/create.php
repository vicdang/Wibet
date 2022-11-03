<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Bet $model
 * @var app\models\Match $match
 */
$this->title = "Create Bet: " . $match->getMatchName();
$this->params['breadcrumbs'][] = ['label' => $match->getMatchName(), 'url' => ['/match/view', 'id' => $match->id]];
$this->params['breadcrumbs'][] = 'Create Bet';
?>
<div class="bet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'match' => $match
    ]) ?>

</div>
