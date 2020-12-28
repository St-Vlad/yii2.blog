<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $updateForm app\blog\entities\Article */
/* @var $statusForm app\blog\entities\Article */

$this->title = 'Update Articles: ' . $updateForm->title;
?>
<div class="articles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'updateForm' => $updateForm,
        'statusForm' => $statusForm,
    ]) ?>

</div>
