<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class GroupAchievementForm extends Model {

    public $persons;
    public $achievement_id;
    public $date;

    public function rules() {
        return [
            [['achievement_id', 'date', 'persons'], 'safe'],
            ['achievement_id, date', 'required'],
        ];
    }

    public function attributeLabels() {
        return [
            'achievement_id' => Yii::t('achievement', 'Achievement'),
        ];
    }

    public function __construct() {
        for ($i = 0; $i < 5; $i++)
            $this->persons[] = 0;

        $this->date = date("Y-m-d h:i");
    }

    public function save() {
        for ($i = 0; $i < count($this->persons) - 1; $i++)
            for ($j = $i + 1; $j < count($this->persons); $j++)
                if ($this->persons[$i] == $this->persons[$j])
                    $this->persons[$j] = 0;

        foreach ($this->persons as $person)
            if ($person != 0) {
                $achievement = Achievement::findOne(['id' => $this->achievement_id]);

                $person_achievement = new PersonAchievement();
                $person_achievement->reward = $achievement->reward;
                $person_achievement->person_id = $person;
                $person_achievement->achievement_id = $this->achievement_id;
                $person_achievement->creator_id = Yii::$app->user->id;
                $person_achievement->date = $this->date;

                $person_achievement->save();
            }

        return true;
    }

}
