<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $person->id == 0 ? Yii::t('person', 'New person') : Yii::t('person', 'Editing person');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['/person']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('person', 'Please fill out the following fields with person data:') ?></p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-person']); ?>
            <?= $form->field($person, 'name') ?>
            <?= $form->field($person, 'surname') ?>
            <?= $form->field($person, 'email') ?>
            <div class="form-group">
                <?= Yii::$app->user->identity->is_administrator ? Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-primary', 'name' => 'save-button']) : '' ?>
                <?= Html::a(\Yii::t('app', 'Cancel'), ['/person'], ['class' => 'btn', 'name' => 'cancel-button']) ?>
            </div>
            <div class="form-group">
                <?= $promotable ? Html::a(\Yii::t('person', 'Promote to user'), ['/person/promote', 'id' => $person->id], ['class' => 'btn btn-default', 'name' => 'cancel-button']) : '' ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>