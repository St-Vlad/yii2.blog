<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="blog" itemscope>
<?php $this->beginBody() ?>
<div id="masthead">
    <div id="site-header" role="banner">
        <div class="container">
            <div class="row">
                <nav id="main-menu" role="navigation" itemscope>
                    <ul class="horizontal-navigation">
                        <?php
                        NavBar::begin([
                            'brandLabel' => Yii::$app->name,
                            'brandUrl' => Yii::$app->homeUrl,
                            'options' => [
                                'class' => 'menu',
                            ],
                        ]);
                        if (Yii::$app->user->isGuest) {
                            $menuItems[] = ['label' => 'Реєстрація', 'url' => ['/signup']];
                            $menuItems[] = ['label' => 'Увійти', 'url' => ['/login']];
                        } else {
                            $menuItems[] = [
                                'label' => 'Створити статтю',
                                'url' => ['/cabinet/articles/create']
                            ];
                            $menuItems[] = [
                                'label' => Yii::$app->user->identity->username,
                                'url' => ['/cabinet']
                            ];
                            $menuItems[] = [
                                'label' => 'Вийти',
                                'url' => ['/logout'],
                                'linkOptions' => ['data-method' => 'post']
                            ];
                        }
                        echo Nav::widget([
                            'options' => ['class' => 'navbar-nav navbar-right'],
                            'items' => $menuItems,
                        ]);
                        NavBar::end();
                        ?>
                    </ul>
                </nav> <!-- #main-menu -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </div> <!-- #site-header -->
</div> <!-- #masthead -->

<main id="content" role="main">
    <div class="section">
        <div class="container">
            <div class="row">

                <div class="three-quarters-block">
                    <div class="content">
                        <!--render view-->
                        <?= $content?>
                        <!--render view-->

                    </div> <!-- .content -->
                </div> <!-- .three-quarters-block -->
            </div> <!-- .section -->
</main> <!-- #content -->
<footer id="footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="copyright">&copy; Стьопич В. В. <?php echo date('Y'); ?></div>
        </div> <!-- .row -->
    </div> <!-- .container -->
</footer> <!-- #footer -->
<!-- Scripts -->
<script type="text/javascript" src="js/jquery-1.11.2.min.js"></script>
<script type="text/javascript" src="js/custom.js"></script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>