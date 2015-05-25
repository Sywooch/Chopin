<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents login page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class HomePage extends BasePage {

    public $route = 'site';

    /**
     * @param string $username
     * @param string $password
     */
    public function login($username, $password) {
        $this->actor->fillField('input[name="LoginForm[username]"]', $username);
        $this->actor->fillField('input[name="LoginForm[password]"]', $password);
        $this->actor->click('login-button');
    }

    public function loginAsAdmin() {
        $this->login('alice', 'password_0');
    }

    public function loginAsSecondAdmin() {
        $this->login('bob', 'password_0');
    }

}
