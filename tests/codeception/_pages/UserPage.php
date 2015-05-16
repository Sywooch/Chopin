<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents contact page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class UserPage extends BasePage {

    public $route = 'user';

    /**
     * @param array $data
     */
    public function submit(array $data) {
        foreach ($data as $field => $value) {
            switch ($field) {
                case 'name':
                case 'surname':
                case 'email':
                    $this->actor->fillField('input[name="Person[' . $field . ']"]', $value);
                    break;
                default:
                    $this->actor->fillField('input[name="User[' . $field . ']"]', $value);
                    break;
            }
        }
        $this->actor->click('save-button');
    }

}