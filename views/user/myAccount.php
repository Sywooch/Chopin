<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('user', 'My Account');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('user', 'Please fill out the following fields with personal data:') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-user']); ?>
            <?= $form->field($user->person, 'name') ?>
            <?= $form->field($user->person, 'surname') ?>
            <?= $form->field($user->person, 'email') ?>
            <?= $form->field($user, 'username') ?>
            <?= $form->field($user, 'password')->passwordInput() ?>
            <?= $form->field($user, 'password_confirm')->passwordInput() ?>
            <div class="form-group">
                <?= Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
                <?= Html::a(\Yii::t('app', 'Cancel'), ['/site'], ['class' => 'btn', 'name' => 'cancel-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>