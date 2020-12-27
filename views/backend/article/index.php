<?php

use app\blog\entities\Article;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\blog\forms\backend\search\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Articles';
?>
<div class="articles-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'category_id',
            'title',
            [
                'attribute' => 'preview',
                'format' => 'html',
                'label' => 'preview',
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
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => [
                    'style' => 'white-space: nowrap; text-align: center; letter-spacing: 0.1em; max-width: 7em;'
                ],
            ],
        ],
    ]); ?>

</div>
