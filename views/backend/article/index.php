<?php

use app\blog\entities\Article;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\blog\forms\backend\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="articles-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            [
                'label' => 'Category',
                'format' => 'ntext',
                'attribute' => 'category_name',
                'value' => function ($model) {
                    return $model->category->category_name;
                },
            ],
            [
                'attribute' => 'preview',
                'format' => 'html',
                'label' => 'Preview',
                'value' => function ($data) {
                    return Html::img(
                        $data->preview,
                        ['width' => '60px']
                    );
                },
            ],
            'description',
            [
                'filter' => Article::getStatusesArray(),
                'attribute' => 'status',
                'value' => 'statusName',
            ],
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
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{swap} {view} {update} {delete}',
                'buttons' => [
                    'swap' => function ($url) {
                        return Html::a(
                            '<span class="glyphicon glyphicon-refresh"></span>',
                            $url,
                            [
                                'id' => 'id',
                            ]
                        );
                    },
                ],
                'contentOptions' => [
                    'style' => 'white-space: nowrap; text-align: center; letter-spacing: 0.1em; max-width: 7em;'
                ],
            ],
        ],
    ]); ?>

</div>
