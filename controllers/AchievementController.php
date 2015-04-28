<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Achievement;

/**
 * People controller
 */
class AchievementController extends Controller {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
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

