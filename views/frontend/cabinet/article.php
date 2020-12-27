<?php

/* @var $this yii\web\View */
/* @var $article \app\blog\entities\Article */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<article class="post hentry" itemscope itemprop="blogPost">
    <header class="entry-header">
        <h2 class="entry-title" itemprop="headline"><?= Html::encode($article->title); ?></h2>
        <div class="entry-meta">
            <span class="post-date">
                <i class="fa fa-clock-o fa-fw"></i>
                <span class="created">
                    <?= $article->created_at; ?>
                </span>
            </span> <!-- .post-date -->
            <span class="post-author">
                <i class="fa fa-user fa-fw"></i> Написана автором <span class="vcard">
                    <?= Html::encode($article->user->username); ?>
            </span> <!-- .post-author -->
            <span>
                <i class="fa fa-pencil" aria-hidden="true"></i>
                <?= Html::a(
                    'Редагувати',
                    Url::to(['frontend/cabinet/articles/update', 'slug' => $article->slug])
                )?>
            </span>
            <span>
                <i class="fa fa-trash" aria-hidden="true"></i>
                <a href="/cabinet/deleteArticle/<?= $article->title; ?>">delete</a>
            </span>
        </div> <!-- .entry-meta -->
    </header> <!-- .entry-header -->
    <div class="entry-thumbnail">
        <?= Html::img($article->preview, ['alt' => $article->title, 'width' => 100, 'height' => 100]);?>
    </div>
    <div class="entry-content" itemprop="articleBody">
        <?= Html::encode($article->description); ?>
    </div> <!-- .entry-content -->
    <?= Html::a(
        'Детальніше',
        Url::to(['frontend/blog/article', 'category' => $article->category->name, 'slug' => $article->slug]),
        ['class' => 'more button']
    )?>
    <hr>
</article> <!-- .post -->