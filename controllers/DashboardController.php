<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\PersonAchievement;
use yii\data\ArrayDataProvider;

class DashboardController extends Controller {

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