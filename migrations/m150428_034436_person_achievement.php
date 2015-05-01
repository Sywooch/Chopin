<?php

use yii\db\Schema;
use yii\db\Migration;

class m150428_034436_person_achievement extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $table = '{{%person_achievement}}';

        $this->createTable($table, [
            'id' => Schema::TYPE_PK,
            'person_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'achievement_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'reward' => Schema::TYPE_MONEY . ' NOT NULL',
            'date' => Schema::TYPE_DATETIME . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                ], $tableOptions);

        $this->addForeignKey('fk_person_achievement_person', $table, 'person_id', 'person', 'id');
        $this->addForeignKey('fk_person_achievement_achievement', $table, 'achievement_id', 'achievement', 'id');
    }

    public function down() {
        $this->dropTable('{{%person_achievement}}');
    }

}
