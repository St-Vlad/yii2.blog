<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\blog\entities\Article */

$this->title = $model->title;
\yii\web\YiiAsset::register($this);
?>
<div class="articles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Змінити', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Видалити', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'category_id',
            'title',
            [
                'attribute' => 'preview',
                'value' => $model->preview,
                'format' => ['image',['width' => '100','height' => '100']],
            ],
            'description',
            'text:html',
            [
                'attribute' => 'status',
                'value' => $model->getStatusName(),
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
