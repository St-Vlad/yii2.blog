<?php

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\DataProviderInterface */
/* @var $searchForm \app\blog\forms\frontend\cabinet\ArticleSearch */
/* @param string $articleView \app\views\frontend\article */

use app\blog\entities\Article;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\LinkPager;

$this->title = Yii::$app->name;

?>

<?php $form = ActiveForm::begin([
    'action' => ['index'],
    'method' => 'get',
]); ?>
<?= $form->field($searchForm, 'status')->dropDownList(Article::getStatusesArray()) ?>

<div class="form-group">
    <?= Html::submitButton('Фільтрувати', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
<div class="content">
<?php foreach ($dataProvider->getModels() as $article) : ?>
    <?= $this->render('article', [
        'article' => $article
    ]) ?>
<?php endforeach; ?>
</div>
<?= LinkPager::widget([
    'pagination' => $dataProvider->pagination,
]); ?>
