<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\money\MaskMoney;

$this->title = $achievement->id == 0 ? Yii::t('achievement', 'New achievement') : Yii::t('achievement', 'Editing achievement');
$this->params['breadcrumbs'][] = Yii::t('achievement', 'Achievement');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="achievement-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-achievement']); ?>
            <?= $form->field($achievement, 'name') ?>
            <?=
            $form->field($achievement, 'reward')->widget(MaskMoney::classname())
            ?>
            <?= $form->field($achievement, 'repeatable')->checkbox() ?>
            <div class="form-group">
                <?= Html::submitButton(\Yii::t('app', 'Save'), ['class' => 'btn btn-primary', 'name' => 'save-button']) ?>
                <?= Html::a(\Yii::t('app', 'Cancel'), ['/achievement'], ['class' => 'btn', 'name' => 'cancel-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>