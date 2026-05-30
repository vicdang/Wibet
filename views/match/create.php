<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Match $model
 */

$this->title = 'Create Match';
?>
<div class="match-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
