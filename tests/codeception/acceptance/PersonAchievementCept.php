<?php

use tests\codeception\_pages\HomePage;
use tests\codeception\_pages\PersonPage;

$I = new AcceptanceTester($scenario);
$I->wantTo('cofirm achievement complete');

$I->amOnPage(Yii::$app->homeUrl);
$homePage = HomePage::openBy($I);
$homePage->loginAsAdmin();
$I->see('12.34');
$I->click('New person achievement');

$I->selectOption('form select[name="PersonAchievement[person_id]"]', 1);
$I->selectOption('form select[name="PersonAchievement[achievement_id]"]', 1);
$I->click('Save');
$I->see('success');

$I->see(11.11 + 12.34);

$I->click("Alice Smith");

$today = date("Y-m-d");

$I->see('11.11');
$I->see('12.34');
$I->see($today);

$I->click('(//a[@title="Delete"])[1]');
$I->dontSee('11.11');
$I->see('12.34');

$I->click("Chopin");
$I->see('12.34');

