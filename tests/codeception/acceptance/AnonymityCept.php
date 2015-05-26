<?php

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that anonymous user can\'t enter pages');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('Sign in');

$I->amOnPage('dashboard');
$I->dontSee('Dashboard');
$I->see('Sign in');

$I->amOnPage('person');
$I->dontSee('Persons');
$I->see('Sign in');

$I->amOnPage('user');
$I->dontSee('Users');
$I->see('Sign in');

$I->amOnPage('achievement');
$I->dontSee('Achievements');
$I->see('Sign in');