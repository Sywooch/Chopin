<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\PersonAchievement;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;

class DashboardController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => false,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex() {
        $top5 = PersonAchievement::getTop5();

        $dataProvider = new ArrayDataProvider([
            'allModels' => $top5,
            'sort' => [
                'attributes' => ['id', 'name', 'surname', 'rewards'],
            ],
        ]);

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
        ]);
    }

}