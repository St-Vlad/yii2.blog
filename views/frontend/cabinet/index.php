<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $searchForm \app\blog\forms\frontend\cabinet\ArticleSearch */

use app\blog\entities\Article;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = Yii::$app->name;

?>

<main id="content" role="main">
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="three-quarters-block">
                    <?php $form = ActiveForm::begin([
                        'action' => ['index'],
                        'method' => 'get',
                    ]); ?>
                    <?= $form->field($searchForm, 'status')->dropDownList(Article::getStatusesArray()) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                    <div class="content">
                        <?php foreach ($dataProvider->getModels() as $article) : ?>
                            <?= $this->render('article', [
                                'article' => $article
                            ]) ?>
                        <?php endforeach; ?>
                    </div> <!-- .content -->
                </div> <!-- .three-quarters-block -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .section -->
</main> <!-- #content -->