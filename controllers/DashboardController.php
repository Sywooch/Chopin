<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\PersonAchievement;

class DashboardController extends Controller
{

    public function actionIndex() {
        $top5 = PersonAchievement::getTop5();
        
        return $this->render('index', [
            'top5' => $top5,
        ]);
    }
}