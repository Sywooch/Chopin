<?php

use yii\db\Schema;
use yii\db\Migration;
use app\models\User;

class m150516_154525_add_isAdministrator extends Migration {

    public function up() {
        $this->addColumn('user', 'is_administrator', Schema::TYPE_BOOLEAN . '  NOT NULL DEFAULT 0');

        $firstUser = User::find()->one();
        $firstUser->is_administrator = true;
        $firstUser->save();
    }

    public function down() {
        $this->dropColumn('user', 'is_administrator');
    }

}
