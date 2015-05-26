<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

$this->title = Yii::t('app', 'People');
$this->params['breadcrumbs'][] = $this->title;

$dataProvider = new ActiveDataProvider([
    'query' => $person,
    'sort' => ['defaultOrder' => ['name' => SORT_ASC, 'surname' => SORT_ASC]],
    'pagination' => [
        'pageSize' => 20,
    ],
        ]);
?>
<div class="person-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data['fullname'], Url::to(['/person/edit', 'id' => $data['id'],]));
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
                'template' => Yii::$app->user->identity->is_administrator ? '{delete}' : '',
                'options' => ['width' => '40px'],
                'urlCreator' => function( $action, $data, $key, $index ) {
                    switch ($action) {
                        case 'delete' : return Url::to(['/person/delete', 'id' => $data['id'],]);
                    };
                },
            ],
        ],
    ]);
    ?>
    <?=
    Yii::$app->user->identity->is_administrator ?
            Html::a(Yii::t('person', 'New person'), Url::to(['person/new']), ['class' => 'btn btn-primary']) : ''
    ?>
</div>

