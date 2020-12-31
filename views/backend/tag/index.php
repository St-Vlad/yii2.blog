<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel \app\blog\forms\backend\search\TagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<?php if (Yii::$app->session->hasFlash('viewError')) : ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i>Error, impossible action</h4>
        <?= Yii::$app->session->getFlash('viewError') ?>
    </div>
<?php endif;?>

<div class="categorie-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'tag_name',
            [
                'class' => 'yii\grid\ActionColumn',
                'contentOptions' => [
                    'style' => 'white-space: nowrap; text-align: center; letter-spacing: 0.1em; max-width: 7em;'
                ],
            ],
        ],
    ]); ?>

</div>
