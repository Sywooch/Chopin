<?php

use yii\db\Schema;
use yii\db\Migration;

class m150516_154525_add_isAdministrator extends Migration {

    public function up() {
        $this->addColumn('{{%user}}', 'is_administrator', Schema::TYPE_BOOLEAN . ' NOT NULL DEFAULT 0');

        $this->update('{{%user}}', ['is_administrator' => 1], ['id' => 1]);
    }

    public function down() {
        $this->dropColumn('{{%user}}', 'is_administrator');
    }

}
