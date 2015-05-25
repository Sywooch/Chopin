<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Achievement;
use yii\filters\AccessControl;

/**
 * People controller
 */
class AchievementController extends Controller {

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
        $achievement = Achievement::find();

        return $this->render('index', [
                    'achievement' => $achievement,
        ]);
    }

    public function actionNew() {
        $achievement = new Achievement();

        if ($achievement->load(Yii::$app->request->post()) && $achievement->save()) {
            \Yii::$app->session->addFlash('success', \Yii::t('achievement', 'Achievement has been succesfully created.'));
            return $this->redirect(['/achievement']);
        }

        return $this->render('form', [
                    'achievement' => $achievement,
        ]);
    }

    public function actionEdit($id) {
        $achievement = Achievement::findOne(['id' => $id]);

        if ($achievement->load(Yii::$app->request->post()) && $achievement->save()) {
            \Yii::$app->session->addFlash('success', \Yii::t('achievement', 'Achievement has been succesfully edited.'));
            return $this->redirect(['/achievement']);
        }

        return $this->render('form', [
                    'achievement' => $achievement,
        ]);
    }

    public function actionDelete($id) {
        $achievement = Achievement::findOne(['id' => $id]);
        if ($achievement->delete()) {
            \Yii::$app->session->addFlash('success', \Yii::t('achievement', 'Achievement has been succesfully deleted.'));
        } else {
            \Yii::$app->session->addFlash('error', \Yii::t('achievement', 'Achievement not deleted: ' . $achievement->getFirstError()));
        }

        return $this->redirect(['/achievement']);
    }

}

