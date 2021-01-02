<?php

use app\blog\entities\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\blog\forms\backend\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<?php if (Yii::$app->session->hasFlash('viewError')) : ?>
    <div class="alert alert-danger alert-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i>Operation error</h4>
        <?= Yii::$app->session->getFlash('viewError') ?>
    </div>
<?php endif;?>

<div class="user-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'email:email',
            [
                'filter' => User::getStatusesArray(),
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
