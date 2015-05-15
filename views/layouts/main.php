<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <link rel="icon" type="image/x-icon" href="../favicon.ico" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
        <?php $this->beginBody() ?>
        <div class="wrap">
            <?php
            NavBar::begin([
                'brandLabel' => 'Chopin',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            $menuItems = [
                ['label' => \Yii::t('app', 'Home'), 'url' => ['/site/index']],
            ];
            if (Yii::$app->user->isGuest) {
                
            } else {
                $menuItems[] = ['label' => Yii::t('app', 'People'),
                    'url' => ['/person']];
                $menuItems[] = ['label' => Yii::t('person', 'New person achievement'),
                    'url' => ['/person/achievement']];
                $menuItems[] = ['label' => Yii::t('app', 'Achievements'),
                    'url' => ['/achievement']];
                $menuItems[] = ['label' => Yii::t('app', 'My account'),
                    'url' => ['/user/my-account']];
                $menuItems[] = [
                    'label' => \Yii::t('app', 'Logout') . ' (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/site/logout'],
                ];
            }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $menuItems,
            ]);
            NavBar::end();
            ?>

            <div class="container">
                <?=
                Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ])
                ?>
                <?= Alert::widget() ?>
                <?= $content ?>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">
                    <?= Html::a('Fundación Empowerment', 'http://www.fundacionempowerment.org/') ?>
                    &nbsp;
                    <?= Html::a('Español', ['site/es']) ?>
                    &nbsp;
                    <?= Html::a('English', ['site/en']) ?>
                </p>
                <p class="pull-right">
                    <?= Yii::t('app', 'Powered by') ?>
                    <?= Html::a('Yii Framework', 'http://www.yiiframework.com/', ['rel' => 'external', 'target' => '_blank']) ?>
                </p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>