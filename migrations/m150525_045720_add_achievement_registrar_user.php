<?php

use yii\db\Schema;
use yii\db\Migration;

class m150525_045720_add_achievement_registrar_user extends Migration {

    public function up() {
        $this->addColumn('{{%person_achievement}}', 'creator_id', Schema::TYPE_INTEGER . ' NOT NULL');

        $this->execute('update {{%person_achievement}} set creator_id = 1');
    }

    public function down() {
        $this->dropColumn('{{%person_achievement}}', 'creator_id');
    }

}
