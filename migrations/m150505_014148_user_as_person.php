<?php

use yii\db\Schema;
use yii\db\Migration;
use app\models\User;
use app\models\Person;

class m150505_014148_user_as_person extends Migration {

    public function safeUp() {
        $this->addColumn('{{%user}}', 'person_id', Schema::TYPE_INTEGER);

        $this->execute('insert into {{%person}} (name, surname, email) select username, username, email from {{%user}}');
        $this->execute('update {{%user}} set person_id = (select id from {{%person}} where {{%person}}.name = {{%user}}.username)');
        $users = User::find()->all();

        $this->dropColumn('{{%user}}', 'email');
    }

    public function safeDown() {
        $this->addColumn('{{%user}}', 'email', Schema::TYPE_STRING);

        $users = User::find()->all();

        foreach ($users as $user) {
            $person = Person::findOne(['id' => $user->person_id]);
            $user->email = $person->email;

            $user->save();

            $person->delete();
        }
        $this->dropColumn('{{%user}}', 'person_id');
    }

}
