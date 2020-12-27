<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

use yii\widgets\LinkPager;

$this->title = Yii::$app->name;

?>

<main id="content" role="main">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="three-quarters-block">
                    <div class="content">
                        <?php foreach ($dataProvider->getModels() as $article) : ?>
                            <?= $this->render('article', [
                                'article' => $article
                            ]) ?>
                        <?php endforeach; ?>
                    </div> <!-- .content -->
                    <?= LinkPager::widget([
                        'pagination' => $dataProvider->pagination,
                    ]); ?>
                </div> <!-- .three-quarters-block -->
                <div class="one-quarter-block" role="complementary">
                    <div class="sidebar">
                        <?= \app\components\CategoryWidget::widget() ?>
                    </div> <!-- .row -->
                </div> <!-- .container -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .section -->
</main> <!-- #content -->