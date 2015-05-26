<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Query;

/**
 * Person model
 */
class Person extends ActiveRecord {

    public $fullname;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['surname', 'filter', 'filter' => 'trim'],
            ['surname', 'required'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetAttribute' => 'email'],
            [['name', 'surname'], 'unique', 'targetAttribute' => ['name', 'surname'], 'on' => 'new'],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => Yii::t('person', 'Name'),
            'surname' => Yii::t('person', 'Surname'),
            'email' => Yii::t('person', 'Email'),
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function afterFind() {
        $this->fullname = $this->name . ' ' . $this->surname;
    }

    public function getAchievementsQuery() {
        return (new Query())->select('pa.id, a.name, pa.reward, pa.date, {{%person}}.name as creator_name, {{%person}}.surname as creator_surname')
                        ->from('person_achievement pa')
                        ->innerJoin('achievement a', 'pa.achievement_id = a.id')
                        ->innerJoin('{{%user}}', 'pa.creator_id = {{%user}}.id')
                        ->innerJoin('{{%person}}', '{{%person}}.id = {{%user}}.person_id')
                        ->where(['pa.person_id' => $this->id])
                        ->orderBy('date desc');
    }

}
