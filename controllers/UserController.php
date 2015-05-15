<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;

/**
 * User controller
 */
class UserController extends Controller {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
        ];
    }

    public function actionIndex() {
        $user = User::find();

        return $this->render('index', [
                    'user' => $user,
        ]);
    }

    public function actionNew() {
        $user = new User();

        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            \Yii::$app->session->addFlash('success', \Yii::t('user', 'User has been succesfully created.'));
            return $this->redirect(['/user']);
        }

        return $this->render('form', [
                    'user' => $user,
        ]);
    }

    public function actionEdit($id) {
        $user = User::findOne(['id' => $id]);

        if ($user->load(Yii::$app->request->post()) && $user->save()) {
            \Yii::$app->session->addFlash('success', \Yii::t('user', 'User has been succesfully edited.'));
            return $this->redirect(['/user']);
        }

        return $this->render('form', [
                    'user' => $user,
        ]);
    }

    public function actionDelete($id) {
        $user = User::findOne(['id' => $id]);
        if ($user->delete()) {
            \Yii::$app->session->addFlash('success', \Yii::t('user', 'User has been succesfully deleted.'));
        } else {
            \Yii::$app->session->addFlash('error', \Yii::t('user', 'User not deleted: ') . $user->getFirstError());
        }

        return $this->redirect(['/user']);
    }

    public function actionMyAccount() {
        if (Yii::$app->user->isGuest)
            $this->goHome();

        $user = User::findOne(['id' => Yii::$app->user->id]);

        if (isset($user))
            if ($user->load(Yii::$app->request->post()) &&
                    $user->person->load(Yii::$app->request->post()) &&
                    $user->save() &&
                    $user->person->save()) {
                \Yii::$app->session->addFlash('success', \Yii::t('user', 'Your personal data has been succesfully saved.'));
                return $this->redirect(['/dashboard']);
            } else {
                SiteController::FlashErrors($user);
                SiteController::FlashErrors($user->person);
            }

        return $this->render('myAccount', [
                    'user' => $user,
        ]);
    }

}

