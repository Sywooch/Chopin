<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\db\Query;

/**
 * Person model
 */
class PersonAchievement extends ActiveRecord {

    public $person;
    public $achievement;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['person_id', 'achievement_id', 'date'], 'required'],
        ];
    }

    public function attributeLabels() {
        return [
            'person_id' => Yii::t('person', 'Person'),
            'achievement_id' => Yii::t('achievement', 'Achievement'),
            'reward' => Yii::t('achievement', 'Reward'),
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

    public function afterFind() {
        $this->person = Person::find(['id' => $this->person_id]);
        $this->achievement = Achievement::find(['id' => $this->achievement_id]);
    }

    public function beforeValidate() {
        if (!isset($this->date))
            $this->date = date(DATE_ISO8601);
        
        return true;
    }

    public static function getTop5() {
        $top5query = (new Query())->select("p.id, p.name, p.surname, sum(pa.reward) as rewards")
                ->from('person_achievement pa')
                ->rightJoin('person p', 'p.Id = pa.person_id')
                ->groupBy('p.id, p.name, p.surname')
                ->orderBy('rewards desc')
                ->limit(5)
                ->all();

        return $top5query;
    }

}
