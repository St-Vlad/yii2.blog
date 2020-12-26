<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\blog\entities\Article */

$this->title = 'Update Articles: ' . $model->title;
?>
<div class="articles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
