<?php

use yii\db\Schema;
use yii\db\Migration;

class m150428_010852_add_achievement_tables extends Migration {

    public function up() {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%achievement}}', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . ' NOT NULL',
            'reward' => Schema::TYPE_MONEY . ' NOT NULL',
            'repeatable' => Schema::TYPE_BOOLEAN . ' NOT NULL',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL',
                ], $tableOptions);
    }

    public function down() {
        $this->dropTable('{{%achievement}}');
    }

}
