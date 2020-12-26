<?php

/* @var $this yii\web\View */
/* @var $model \app\blog\entities\Article */

use yii\helpers\Html;

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
            <i class="fa fa-user fa-fw"></i> Написана автором <span class="vcard">
                <?= $model->user->username ;?>
            </span> <!-- .post-author -->
        </div> <!-- .entry-meta -->
    </header> <!-- .entry-header -->
    <div class="entry-content" itemprop="articleBody">
        <?= $model->text; ?>
    </div> <!-- .entry-content -->
</article> <!-- .post --><?php
