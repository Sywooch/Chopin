<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use app\models\Person;

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

    public function beforeAction($action) {
        if ($action->id != 'my-account' && !Yii::$app->user->identity->is_administrator) {
            \Yii::$app->session->addFlash('error', \Yii::t('app', 'Access denied'));
            $this->redirect(['/dashboard']);
        }
        return parent::beforeAction($action);
    }

    public function actionIndex() {

        $user = User::find();

        return $this->render('index', [
                    'user' => $user,
        ]);
    }

    public function actionNew($personId = null) {
        $user = new User();

        if (isset($personId)) {
            $person = Person::findOne(['id' => $personId]);
            $user->username = strtolower($person->name . '.' . $person->surname);
        }
        else
            $person = New Person();

        if ($this->save($user, $person)) {
            \Yii::$app->session->addFlash('success', \Yii::t('user', 'User has been succesfully created.'));
            return $this->redirect(['/user']);
        } else {
            $this->flashErrors($user, $person);
        }

        return $this->render('form', [
                    'user' => $user,
                    'person' => $person,
                    'return' => '/user',
        ]);
    }

    public function actionEdit($id) {
        $user = User::findOne(['id' => $id]);

        if ($this->save($user)) {
            \Yii::$app->session->addFlash('success', \Yii::t('user', 'User has been succesfully edited.'));
            return $this->redirect(['/user']);
        } else {
            $this->flashErrors($user);
        }

        return $this->render('form', [
                    'user' => $user,
                    'person' => $user->person,
                    'return' => '/user',
        ]);
    }

    public function actionDelete($id) {
        $user = User::findOne(['id' => $id]);
        if ($user->delete()) {
            \Yii::$app->session->addFlash('success', \Yii::t('user', 'User has been succesfully deleted.'));
        } else {
            $this->flashErrors($user);
        }

        return $this->redirect(['/user']);
    }

    public function actionMyAccount() {
        if (Yii::$app->user->isGuest)
            $this->goHome();

        $user = User::findOne(['id' => Yii::$app->user->id]);

        if ($this->save($user)) {
            \Yii::$app->session->addFlash('success', \Yii::t('user', 'Your personal data has been succesfully saved.'));
            return $this->redirect(['/dashboard']);
        } else {
            $this->flashErrors($user);
        }

        return $this->render('myAccount', [
                    'user' => $user,
                    'person' => $user->person,
                    'return' => '/site',
        ]);
    }

    private function save($user, $person = null) {
        if ($person == null)
            $person = $user->person;

        if ($person->load(Yii::$app->request->post()) && $person->save()) {
            $user->link('person', $person);
            if ($user->load(Yii::$app->request->post()) && ($user->save()))
                return true;
        }
        return false;
    }

    private function flashErrors($user, $person = null) {
        if ($person == null)
            $person = $user->person;

        SiteController::FlashErrors($user);
        SiteController::FlashErrors($user->person);
    }

}

