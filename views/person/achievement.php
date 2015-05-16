<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;

$this->title = Yii::t('person', 'New group achievement');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'People'), 'url' => ['/person']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-achievement">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Yii::t('person', 'Please fill out the following fields to register the group achievement:') ?></p>

    <div class="row">
        <div class="col-md-5">
            <?php $form = ActiveForm::begin(['id' => 'form-person-achievement']); ?>
            <div class="thumbnail">
                <?php
                for ($i = 0; $i < 5; $i++) {
                    echo $form->field($group, "persons[$i]")
                            ->label(Yii::t('person', 'Person') . ' ' . ($i + 1))->widget(Select2::classname(), [
                        'data' => $persons,
                        'options' => ['placeholder' => \Yii::t('person', 'Select a person ...')],
                        'pluginOptions' => ['allowClear' => false],
                    ]);
                }
                ?>
            </div>
            <?=
            $form->field($group, 'achievement_id')->widget(Select2::classname(), [
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