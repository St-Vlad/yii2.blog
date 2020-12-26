<?php

/* @var $this yii\web\View */
/* @var $article \app\blog\entities\Article */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<article class="post hentry" itemscope itemprop="blogPost">
    <header class="entry-header">
        <h2 class="entry-title" itemprop="headline"><?= $article->title; ?></h2>
        <div class="entry-meta">
            <span class="post-date">
                <i class="fa fa-clock-o fa-fw"></i>
                <span class="created">
                    <?= $article->created_at; ?>
                </span>
            </span> <!-- .post-date -->
            <span class="post-author">
                <i class="fa fa-user fa-fw"></i> Написана автором <span class="vcard">
                    <?= $article->user->username ;?>
                </span> <!-- .post-author -->
        </div> <!-- .entry-meta -->
    </header> <!-- .entry-header -->
    <div class="entry-content" itemprop="articleBody">
        <?= $article->description; ?>
    </div> <!-- .entry-content -->
    <?= Html::a(
        'Детальніше',
        Url::to(['frontend/blog/article', 'category' => $article->category->name, 'title' => $article->title]),
        ['class' => 'more button']
    )?>
    <hr>
</article> <!-- .post -->