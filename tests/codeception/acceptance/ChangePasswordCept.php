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

$I->amGoingTo('change my password');
$myAccountPage->submit([
    'password' => '123456',
    'password_confirm' => '123456',
]);
$I->see('success');

$I->click('Logout (alice)');

$I->see('Login');
$homePage->login('alice', '123456');

$I->see('Dashboard');

$I->click('My account');
$I->amGoingTo('change my password again');
$myAccountPage->submit([
    'password' => 'password_0',
    'password_confirm' => 'password_0',
]);
$I->see('success');
