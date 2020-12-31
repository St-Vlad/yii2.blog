<?php

use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;
use unclead\multipleinput\MultipleInput;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\blog\entities\Article */
/* @var $form yii\widgets\ActiveForm */
/* @var $categoriesList app\blog\entities\Article*/
?>

<div class="articles-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'category_id')->dropDownList(
        ArrayHelper::map($categoriesList, 'id', 'name')
    ); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'preview')->widget(InputFile::className(), [
        'language'      => 'ru',
        'controller'    => 'elfinder',
        'filter'        => 'image',
        'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
        'options'       => ['class' => 'form-control'],
        'buttonOptions' => ['class' => 'btn btn-default'],
        'multiple'      => false,
    ]); ?>

    <?= $form->field($model, 'tags')->widget(MultipleInput::class, [
        'max'               => 6,
        'min'               => 0,
        'allowEmptyList'    => true,
        'enableGuessTitle'  => true,
        'addButtonPosition' => MultipleInput::POS_HEADER,
    ])->label(false); ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'editorOptions' => ElFinder::ckeditorOptions('elfinder', [
            'preset' => 'full',
            'inline' => false,
            'filter' => [
                'image/png',
                'image/jpeg',
            ],
        ])
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton('Update', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


