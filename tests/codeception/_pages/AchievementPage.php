<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents login page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class AchievementPage extends BasePage {

    public $route = 'achievement';

    /**
     * @param string $username
     * @param string $password
     */
    public function fillForm($name, $reward, $repeatable) {
        $this->actor->fillField('input[name="Achievement[name]"]', $name);
        $this->actor->fillField('input[name="Achievement[reward]"]', $reward);
        $this->actor->fillField('input[name="Achievement[repeatable]"]', $repeatable);
        $this->actor->click('save-button');
    }

}
