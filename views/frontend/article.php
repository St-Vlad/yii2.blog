<?php

/* @var $this yii\web\View */
/* @var $article \app\blog\entities\Article */
/* @var $tag \app\blog\entities\Tag */

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
                <i class="fa fa-user fa-fw"></i> Written by <span class="vcard">
                    <?= $article->user->username ?? "Unknown author";?>
            </span> <!-- .post-author -->
            <span class="post-categories">
                <i class="fa fa-folder fa-fw"></i>
                <?= Html::a(
                    Html::encode($article->category->name),
                    Url::to(['frontend/blog/category', 'slug' => $article->category->slug])
                ); ?>
            </span>
            <?php if ($article->tag) : ?>
            <span class="post-tags">
                <i class="fa fa-tags fa-fw"></i>
                <?php foreach ($article->tag as $tag) : ?>
                    <?= Html::a('#' . $tag->name, Url::to(['frontend/blog/tag', 'name' => $tag->name])); ?>
                <?php endforeach; ?>
            </span>
            <?php endif; ?>
        </div> <!-- .entry-meta -->
    </header> <!-- .entry-header -->
    <div class="entry-thumbnail">
        <?= Html::img($article->preview, ['alt' => $article->title, 'width' => 100, 'height' => 100]);?>
    </div>
    <div class="entry-content" itemprop="articleBody">
        <?= $article->description; ?>
    </div> <!-- .entry-content -->
    <?= Html::a(
        'More details',
        Url::to(['frontend/blog/article', 'category' => $article->category->slug, 'slug' => $article->slug]),
        ['class' => 'more button']
    )?>
    <hr>
</article> <!-- .post -->