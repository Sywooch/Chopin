<?php

use tests\codeception\_pages\MyAccountPage;
use tests\codeception\_pages\HomePage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that my account works');

$I->amOnPage(Yii::$app->homeUrl);

$homePage = HomePage::openBy($I);
$I->see('Login');
$homePage->login('alice', 'password_0');

$I->see('Dashboard');

$myAccountPage = MyAccountPage::openBy($I);

$I->see('My Account');

$I->amGoingTo('submit contact form with changed data');
$myAccountPage->submit([
    'name' => 'tester1',
    'surname' => 'tester2',
    'username' => 'tester3',
    'email' => 'tester@email.com',
    'password' => '',
    'password_confirm' => '',
]);
$I->see('success');

$I->click('My account');

$I->see('tester1');
$I->see('tester2');
$I->see('tester3');
$I->see('tester@email.com');

$myAccountPage->submit([
    'name' => 'Alice',
    'surname' => 'Smith',
    'username' => 'alice',
    'email' => 'alice@wonder.com',
    'password' => '',
    'password_confirm' => '',
]);
$I->see('success');
