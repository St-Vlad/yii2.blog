<?php

use app\blog\entities\Article;
use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $updateForm app\blog\entities\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($updateForm, 'category_id')->textInput() ?>

    <?= $form->field($updateForm, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($updateForm, 'preview')->widget(InputFile::className(), [
        'language'      => 'en',
        'controller'    => 'elfinder',
        'filter'        => 'image',
        'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options'       => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
        'multiple'      => false,
    ]); ?>

    <?= $form->field($updateForm, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($updateForm, 'text')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
            'inline' => false,
            'filter' => [
                'image/png',
                'image/jpeg',
            ],
        ])
    ]); ?>

    <?= $form->field($updateForm, 'status')->dropDownList(Article::getStatusesArray()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
