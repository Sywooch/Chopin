<?php

use yii\db\Schema;
use yii\db\Migration;
use app\models\User;
use app\models\Person;

class m150505_014148_user_as_person extends Migration {

    public function safeUp() {
        $this->addColumn('user', 'person_id', Schema::TYPE_INTEGER);

        $users = User::find()->all();

        foreach ($users as $user) {
            $person = new Person();
            $person->name = $user->username;
            $person->surname = $user->username;
            $person->email = $user->email;

            $person->save();

            $user->person_id = $person->id;
            $user->save();
        }

        $this->dropColumn('user', 'email');
    }

    public function safeDown() {
        $this->addColumn('user', 'email', Schema::TYPE_STRING);

        $users = User::find()->all();

        foreach ($users as $user) {
            $person = Person::findOne(['id' => $user->person_id]);
            $user->email = $person->email;

            $user->save();

            $person->delete();
        }
        $this->dropColumn('user', 'person_id');
    }

}
