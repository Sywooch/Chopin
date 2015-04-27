<?php

use tests\codeception\_pages\HomePage;
use tests\codeception\_pages\PersonPage;

$I = new AcceptanceTester($scenario);
$I->wantTo('perform CRUD actions');

$I->amOnPage(Yii::$app->homeUrl);
$homePage = HomePage::openBy($I);
$homePage->loginAsAdmin();
$I->click('People');
$I->see('People', 'h1');

$personPage = new PersonPage($I);

$I->amGoingTo("create a person");
$I->click('New person');
$I->see('New person', 'h1');

$personPage->fillForm('', '', '');
$I->see('Name cannot be blank.', '.help-block');
$I->see('Surname cannot be blank.', '.help-block');
$I->see('Email cannot be blank.', '.help-block');

$personPage->fillForm('Jhon', 'Dow', 'm');
$I->see('Email is not a valid email address.');

$personPage->fillForm('Jhon', 'Dow', 'jhon@dow.com.ar');
$I->see('success');
$I->see('Jhon Dow');

$I->click('Jhon Dow');
$I->see('Editing person', 'h1');

$personPage->fillForm('Jhonny', 'Dow', 'jhon@dow.com.ar');
$I->see('success');
$I->see('Jhonny Dow');

$I->click('a[title="Delete"]');
$I->see('success');
$I->dontSee('Jhonny Dow');
