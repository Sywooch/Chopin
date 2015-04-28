<?php

use tests\codeception\_pages\HomePage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Chopin');
$I->see('Empowerment');
$I->dontSee("My Company");
$I->see('Login');
$I->see('Password');
$I->see('Sign in');

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure login works');

$homePage = HomePage::openBy($I);

$I->amGoingTo('submit login form with no data');
$homePage->login('', '');
$I->expectTo('see validations errors');
$I->see('Username cannot be blank.', '.help-block');
$I->see('Password cannot be blank.', '.help-block');

$I->amGoingTo('try to login with wrong credentials');
$I->expectTo('see validations errors');
$homePage->login('admin', 'wrong');
$I->expectTo('see validations errors');
$I->see('Incorrect username or password.', '.help-block');

$I->amGoingTo('try to login with correct credentials');
$homePage->login('alice', 'password_0');
$I->expectTo('see that user is logged');
$I->seeLink('Logout (alice)');
$I->dontSeeLink('Login');
$I->dontSeeLink('Signup');