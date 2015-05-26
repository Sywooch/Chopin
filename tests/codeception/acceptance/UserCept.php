<?php

use tests\codeception\_pages\HomePage;
use tests\codeception\_pages\UserPage;

$I = new AcceptanceTester($scenario);
$I->wantTo('perform CRUD actions');

$I->amOnPage(Yii::$app->homeUrl);
$homePage = HomePage::openBy($I);
$homePage->loginAsAdmin();
$I->click('Users');
$I->see('Users', 'h1');

$userPage = new UserPage($I);

$I->amGoingTo("create a user");
$I->click('New user');
$I->see('New user', 'h1');

$userPage->submit([
    'name' => 'Jhon',
    'surname' => 'Dow',
    'username' => 'jdow',
    'email' => 'jhon@email.com',
    'password' => 'jdow123',
    'password_confirm' => 'jdow123',
]);

$I->see('success');
$I->see('Jhon Dow');

$I->click('Logout (alice)');

$I->see('Login');
$homePage->login('jdow', 'jdow123');

$I->see('Logout (jdow)');

$I->click('Logout (jdow)');

$homePage->loginAsAdmin();
$I->click('Users');

$I->click('(//a[@title="Delete"])[3]');
$I->see('success');
$I->dontSee('Jhonny Dow');