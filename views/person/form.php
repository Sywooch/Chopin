<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = $person->id == 0 ? Yii::t('person', 'New person') : Yii::t('person', 'Editing person');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['/person']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-form">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-md-8">
            <?= Yii::t('person', 'Please fill out the following fields with person data:') ?>
        </div>
        <div class="col-md-4 text-right">
            <?= $person->isNewRecord ? '' : Html::a(\Yii::t('person', 'View achievements'), ['/person/achievements', 'id' => $person->id], ['class' => 'btn btn-default', 'name' => 'achievements-button']) ?>
            <?= $promotable ? Html::a(\Yii::t('person', 'Promote to user...'), ['/user/new', 'personId' => $person->id], ['class' => 'btn btn-default', 'name' => 'promote-button']) : '' ?>
        </div>
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(['id' => 'form-person']); ?>
            <?= $form->field($person, 'name') ?>
            <?= $form->field($person, 'surname') ?>
            <?= $form->field($person, 'email') ?>
            <div class="form-group">
                <?= Yii::$app->user->identity->is_administrator ? Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-primary', 'name' => 'save-button']) : '' ?>
                <?= Html::a(\Yii::t('app', 'Cancel'), ['/person'], ['class' => 'btn', 'name' => 'cancel-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>