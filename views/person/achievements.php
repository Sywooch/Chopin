<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\Achievement */

$this->title = Yii::t('app', 'Achievements of ') . $person->fullname;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="person-achievements">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => $achievements,
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => Yii::t('achievement', 'Name'),
                'value' => 'name',
            ],
            [
                'attribute' => Yii::t('achievement', 'Reward'),
                'value' => 'reward',
            ],
            [
                'attribute' => Yii::t('achievement', 'Date'),
                'value' => 'date',
            ],
            [
                'attribute' => Yii::t('achievement', 'Creator'),
                'format' => 'text',
                'value' => function ($data) {
                    return $data['creator_name']. ' ' . $data['creator_surname'];
                }],
            ['class' => 'yii\grid\ActionColumn',
                'template' => Yii::$app->user->identity->is_administrator ? '{delete}' : '',
                'options' => ['width' => '40px'],
                'urlCreator' => function( $action, $data, $key, $index ) {
                    switch ($action) {
                        case 'delete' : return Url::to(['/person/deleteachievement', 'id' => $data['id'],]);
                    };
                },
            ],
        ],
    ]);
    ?>
</div>

