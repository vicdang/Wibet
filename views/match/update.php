<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Match $model
 */
$this->title = !isset($update_score) ? 'Update Match' : 'Update Score';
$this->params['breadcrumbs'][] = ['label' => 'Matches', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getMatchTitle(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="match-update">

    <h1> <?= $this->title . ": " . $model->getMatchName() ?></h1>

    <?= $this->render(!isset($update_score) ? '_form' : '_form_score', [
        'model' => $model,
    ]) ?>

</div>
