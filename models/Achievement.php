<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * Achievement model
 */
class Achievement extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetAttribute' => 'name'],
            ['reward', 'required'],
            ['reward', 'compare', 'compareValue' => 0, 'operator' => '>'],
            ['reward', 'compare', 'compareValue' => 1000, 'operator' => '<'],
            ['repeatable', 'boolean'],
        ];
    }

    public function attributeLabels() {
        return [
            'name' => Yii::t('achievement', 'Name'),
            'reward' => Yii::t('achievement', 'Reward'),
            'repeatable' => Yii::t('achievement', 'Repeatable'),
        ];
    }

    public function behaviors() {
        return [
            TimestampBehavior::className(),
        ];
    }

}
