<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Person;
use app\models\PersonAchievement;
use app\models\GroupAchievementForm;
use app\models\Achievement;
use yii\db\Query;
use app\models\User;
use yii\filters\AccessControl;

/**
 * People controller
 */
class PersonController extends Controller {

    public function behaviors() {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [ 'allow' => true, 'roles' => ['@'],],
                ],
            ],
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
                    'promotable' => false,
        ]);
    }

    public function actionEdit($id) {
        $person = Person::findOne(['id' => $id]);

        if ($person->load(Yii::$app->request->post()) && $person->save()) {
            \Yii::$app->session->addFlash('success', \Yii::t('person', 'Person has been succesfully edited.'));
            return $this->redirect(['/person']);
        }

        $user = User::findOne(['person_id' => $id]);

        return $this->render('form', [
                    'person' => $person,
                    'promotable' => !isset($user),
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
        $group = new GroupAchievementForm();

        if (Yii::$app->request->isPost) {
            if ($group->load(Yii::$app->request->post())) {
                if ($group->save()) {
                    \Yii::$app->session->addFlash('success', \Yii::t('achievement', 'Achievements have been succesfully created.'));
                    return $this->redirect(['/dashboard']);
                }
            }
        }

        foreach (Person::find()->all() as $person) {
            $persons[$person->id] = $person->fullname;
        }

        foreach (Achievement::find()->all() as $achievement) {
            $achievements[$achievement->id] = sprintf('%s (%f)', $achievement->name, $achievement->reward);
        }

        return $this->render('achievement', [
                    'group' => $group,
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

    public function actionPromote($id) {
        $person = Person::findOne(['id' => $id]);
        $user_id = $person->promote();
        return $this->redirect(['/user/edit', 'id' => $user_id]);
    }

}

