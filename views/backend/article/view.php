<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\blog\entities\Article */

\yii\web\YiiAsset::register($this);
?>
<div class="articles-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            [
                'label' => 'Category',
                'format' => 'ntext',
                'attribute' => 'category_name',
                'value' => function ($model) {
                    return $model->category->category_name;
                },
            ],
            'title',
            [
                'attribute' => 'preview',
                'value' => $model->preview,
                'format' => ['image',['width' => '100','height' => '100']],
            ],
            'description',
            [
                'label' => 'Tags',
                'format' => 'ntext',
                'attribute' => 'tag_name',
                'value' => function ($model) {
                    if (!empty($model->tag)) {
                        foreach ($model->tag as $tag) {
                            $tags[] = $tag->tag_name;
                        }
                        return implode(", ", $tags);
                    } else {
                        return 'no tag';
                    }
                },
            ],
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
