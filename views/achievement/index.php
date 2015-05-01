<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\Achievement */

$this->title = Yii::t('app', 'Achievements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="achievement-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    $dataProvider = new ActiveDataProvider([
        'query' => $achievement,
        'pagination' => [
            'pageSize' => 20,
        ],
    ]);
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data['name'], Url::to(['/achievement/edit', 'id' => $data['id'],]));
                },
            ],
            [
                'attribute' => 'reward',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data['reward'], Url::to(['/achievement/edit', 'id' => $data['id'],]));
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
                'options' => ['width' => '40px'],
                'urlCreator' => function( $action, $data, $key, $index ) {
                    switch ($action) {
                        case 'delete' : return Url::to(['/achievement/delete', 'id' => $data['id'],]);
                    };
                },
            ],
        ],
    ]);
    ?>
    <?= Html::a(Yii::t('achievement', 'New achievement'), Url::to(['achievement/new']), ['class' => 'btn btn-primary']) ?>
</div>

