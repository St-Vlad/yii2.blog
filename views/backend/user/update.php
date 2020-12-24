<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\blog\entities\User */

$this->title = 'Update User: ' . $model->username;
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
