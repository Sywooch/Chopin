<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
$this->title = 'Chopin';
?>
<div class="site-index">
    <div class="jumbotron">
        <h1><?= \Yii::t('app', 'Welcome to Chopin!') ?></h1>
        <h2><?= \Yii::t('app', 'Information system of Empowerment Foundation') ?></h2>
    </div>

    <div class="row">
        <div class="col-md-push-4 col-md-4">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <?= $form->field($model, 'username') ?>
            <?= $form->field($model, 'password')->passwordInput() ?>
            <?= $form->field($model, 'rememberMe')->checkbox() ?>
            <div class="form-group">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
            <div style="color:#999;margin:1em 0">
                If you forgot your password you can <?= Html::a('reset it', ['site/request-password-reset']) ?>.
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
