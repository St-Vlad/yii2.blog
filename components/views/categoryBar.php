<?php

/** @var $categories \app\blog\entities\Category*/

use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="widget">
    <h3 class="widget-title">Categories</h3>
    <ul>
        <?php foreach ($categories as $category) :?>
            <?= Html::tag(
                'li',
                Html::a(
                    Html::encode($category->name),
                    Url::to(['frontend/blog/category', 'slug' => $category->slug])
                )
            );?>
        <?php endforeach;?>
    </ul>
</div> <!-- .widget -->
