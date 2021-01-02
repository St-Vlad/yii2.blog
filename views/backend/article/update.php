<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $updateForm app\blog\entities\Article */
/* @var $categoriesList app\blog\entities\Article*/

?>
<div class="articles-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'updateForm' => $updateForm,
        'categoriesList' => $categoriesList,
    ]) ?>

</div>
