<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

/* @var $this yii\web\View */
$this->title = \Yii::t('app', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dashboard-index">
    <h1><?= \Yii::t('dashboard', 'Standings') ?></h1>
    <?php
    echo GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'header' => \Yii::t('person', 'Person'),
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data['name'] . ' ' . $data['surname'], Url::to(['/person/achievements', 'id' => $data['id'],]));
                },
            ],
            [
                'header' => \Yii::t('dashboard', 'Rewards total'),
                'format' => 'html',
                'value' => function ($data) {
                    return Html::a($data['rewards'], Url::to(['/person/achievements', 'id' => $data['id'],]));
                },
            ],
        ],
    ]);
    ?>
    <?= Html::a(Yii::t('person', 'New person achievement'), Url::to(['/person/achievement']), ['class' => 'btn btn-primary']) ?>
</div>
