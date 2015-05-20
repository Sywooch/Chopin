<?php

use yii\db\Schema;
use yii\db\Migration;

class m150501_162800_rewards_to_integers extends Migration {

    public function safeUp() {
        $this->alterColumn('{{%achievement}}', 'reward', Schema::TYPE_INTEGER);
        $this->alterColumn('{{%person_achievement}}', 'reward', Schema::TYPE_INTEGER);
    }

    public function safeDown() {
        $this->alterColumn('{{%achievement}}', 'reward', Schema::TYPE_MONEY);
        $this->alterColumn('{{%person_achievement}}', 'reward', Schema::TYPE_MONEY);
    }

}
