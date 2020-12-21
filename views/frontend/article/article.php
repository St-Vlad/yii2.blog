<?php

/* @var $this yii\web\View */
/* @var $article \app\blog\entities\Article */

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
        <?= $article->text; ?>
    </div> <!-- .entry-content -->
</article> <!-- .post -->