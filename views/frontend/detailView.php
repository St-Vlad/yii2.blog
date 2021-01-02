<?php

/* @var $this yii\web\View */
/* @var $model \app\blog\entities\Article */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<article class="post hentry" itemscope itemprop="blogPost">
    <header class="entry-header">
        <h2 class="entry-title" itemprop="headline"><?= $model->title; ?></h2>
        <div class="entry-meta">
        <span class="post-date">
            <i class="fa fa-clock-o fa-fw"></i>
            <span class="created">
                <?= $model->created_at; ?>
            </span>
        </span> <!-- .post-date -->
            <span class="post-author">
            <i class="fa fa-user fa-fw"></i> Writen by <span class="vcard">
                <?= $model->user->username ?? "unknown author";?>
            </span> <!-- .post-author -->
                <span class="post-categories">
                <i class="fa fa-folder fa-fw"></i>
                <?= Html::a(
                    Html::encode($model->category->category_name),
                    Url::to(['frontend/blog/category', 'slug' => $model->category->slug])
                ); ?>
            </span>
            <?php if ($model->tag) : ?>
                <span class="post-tags">
                <i class="fa fa-tags fa-fw"></i>
                <?php foreach ($model->tag as $tag) : ?>
                    <?= Html::a('#' . $tag->tag_name, Url::to(['frontend/blog/tag', 'tag_name' => $tag->tag_name])); ?>
                <?php endforeach; ?>
            </span>
            <?php endif; ?>
        </div> <!-- .entry-meta -->
    </header> <!-- .entry-header -->
    <div class="entry-content" itemprop="articleBody">
        <?= $model->text; ?>
    </div> <!-- .entry-content -->
</article> <!-- .post -->
