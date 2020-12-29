<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $tagForm \app\blog\forms\frontend\TagForm */

use app\widgets\CategoryWidget;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
                        <div class="search-widget widget">
                            <?php $form = ActiveForm::begin([
                                'action' => 'tag',
                                'options' => [
                                    'class' => 'widget-form'
                                ],
                            ]); ?>
                            <?= $form->field($tagForm, 'title')->textInput([
                                'class' => 'search-field',
                                'placeholder' => 'Search for tags',
                                'value' => '',
                            ])->label(false) ?>
                            <?= Html::submitButton(
                                Html::tag('i', '', ['class' => 'fa fa-search']),
                                ['name' => 'search-button']
                            ) ?>
                            <?php ActiveForm::end(); ?>
                        </div>
                        <?= CategoryWidget::widget() ?>
                    </div> <!-- .row -->
                </div> <!-- .container -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- .section -->
</main> <!-- #content -->