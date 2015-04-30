<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;

$this->title = Yii::t('person', 'New person achievement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('person', 'Person'), 'url' => ['/person']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-achievement">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to register the achievement:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-person-achievement']); ?>
            <?=
            $form->field($person_achievement, 'person_id')->widget(Select2::classname(), [
                'data' => $persons,
                'options' => ['placeholder' => \Yii::t('person', 'Select a person ...')],
                'pluginOptions' => [ 'allowClear' => false],
            ])
            ?>
            <?=
            $form->field($person_achievement, 'achievement_id')->widget(Select2::classname(), [
                'data' => $achievements,
                'options' => ['placeholder' => \Yii::t('person', 'Select an achievement ...')],
                'pluginOptions' => [ 'allowClear' => false],
            ])
            ?>
            <div class="form-group">
                <?= Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
                <?= Html::a(\Yii::t('app', 'Cancel'), ['/person'], ['class' => 'btn', 'name' => 'cancel-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>