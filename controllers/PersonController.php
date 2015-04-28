<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Person;

/**
 * People controller
 */
class PersonController extends Controller {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
        ];
    }

    public function actionIndex() {
        $person = Person::find();

        return $this->render('index', [
                    'person' => $person,
        ]);
    }

    public function actionNew() {
        $person = new Person();

        if ($person->load(Yii::$app->request->post()) && $person->save()) {
            \Yii::$app->session->addFlash('success', \Yii::t('person', 'Person has been succesfully created.'));
            return $this->redirect(['/person']);
        }

        return $this->render('form', [
                    'person' => $person,
        ]);
    }

    public function actionEdit($id) {
        $person = Person::findOne(['id' => $id]);

        if ($person->load(Yii::$app->request->post()) && $person->save()) {
            \Yii::$app->session->addFlash('success', \Yii::t('person', 'Person has been succesfully edited.'));
            return $this->redirect(['/person']);
        }

        return $this->render('form', [
                    'person' => $person,
        ]);
    }

    public function actionDelete($id) {
        $person = Person::findOne(['id' => $id]);
        if ($person->delete()) {
            \Yii::$app->session->addFlash('success', \Yii::t('person', 'Person has been succesfully deleted.'));
        } else {
            \Yii::$app->session->addFlash('error', \Yii::t('person', 'Person not deleted: ' . $person->getFirstError()));
        }

        return $this->redirect(['/person']);
    }

}

