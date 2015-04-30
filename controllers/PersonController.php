<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Person;
use app\models\PersonAchievement;
use app\models\Achievement;
use yii\db\Query;

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
            \Yii::$app->session->addFlash('error', \Yii::t('person', 'Person not deleted: ') . $person->getFirstError());
        }

        return $this->redirect(['/person']);
    }

    public function actionAchievement() {
        $person_achievement = new PersonAchievement();

        if ($person_achievement->load(Yii::$app->request->post())) {
            $achievement = Achievement::findOne(['id' => $person_achievement->achievement_id]);
            $person_achievement->reward = $achievement->reward;

            if ($person_achievement->save()) {
                \Yii::$app->session->addFlash('success', \Yii::t('person', 'Person achievement has been succesfully edited.'));
                return $this->redirect(['/dashboard']);
            } else {
                foreach ($person_achievement->getErrors() as $attribute => $errors)
                    foreach ($errors as $error)
                        \Yii::$app->session->addFlash('error', \Yii::t('person', 'Person achievement not saved: ') . $error);
            }
        }

        foreach (Person::find()->all() as $person) {
            $persons[$person->id] = $person->fullname;
        }

        foreach (Achievement::find()->all() as $achievement) {
            $achievements[$achievement->id] = sprintf('%s (%f)', $achievement->name, $achievement->reward);
        }

        return $this->render('achievement', [
                    'person_achievement' => $person_achievement,
                    'persons' => $persons,
                    'achievements' => $achievements,
        ]);
    }

    public function actionAchievements($id) {
        $personId = $id;

        $person = Person::findOne(['id' => $personId]);

        $achievements = (new Query())->select('pa.id, a.name, pa.reward, pa.date')
                ->from('person_achievement pa')
                ->innerJoin('achievement a', 'pa.achievement_id = a.id')
                ->where(['pa.person_id' => $personId])
                ->orderBy('date desc');

        return $this->render('achievements', [
                    'person' => $person,
                    'achievements' => $achievements,
        ]);
    }

    public function actionDeleteachievement($id) {
        $achievement = PersonAchievement::findOne(['id' => $id]);

        $person = Person::findOne(['id' => $achievement->person_id]);

        if ($achievement->delete()) {
            \Yii::$app->session->addFlash('success', \Yii::t('person', 'Person achievement has been succesfully deleted.'));
        } else {
            \Yii::$app->session->addFlash('error', \Yii::t('person', 'Person achievement not delete:')
                    . $achievement->getErrors());
        }
        return $this->redirect(['/person/achievements', 'id' => $person->id]);
    }

}

