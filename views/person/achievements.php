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
                'attribute' => 'name',
            ],
            [
                'attribute' => 'reward',
            ],
            [
                'attribute' => 'date',
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
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

