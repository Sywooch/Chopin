<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents login page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class PersonPage extends BasePage {

    public $route = 'person';

    /**
     * @param string $username
     * @param string $password
     */
    public function fillForm($name, $surname, $email) {
        $this->actor->fillField('input[name="Person[name]"]', $name);
        $this->actor->fillField('input[name="Person[surname]"]', $surname);
        $this->actor->fillField('input[name="Person[email]"]', $email);
        $this->actor->click('save-button');
    }

}
