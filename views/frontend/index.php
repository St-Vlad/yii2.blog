<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */

$this->title = Yii::$app->name;

?>

<main id="content" role="main">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="three-quarters-block">
                    <div class="content">
                        <?php foreach ($dataProvider->getModels() as $article): ?>
                            <?= $this->render('article/article', [
                                'article' => $article
                            ]) ?>
                        <?php endforeach; ?>
                    </div> <!-- .content -->
                </div> <!-- .three-quarters-block -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .section -->
</main> <!-- #content -->