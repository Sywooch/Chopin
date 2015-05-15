<?php

use tests\codeception\_pages\HomePage;

$I = new AcceptanceTester($scenario);
$I->wantTo('confirm achievement complete');

$I->amOnPage(Yii::$app->homeUrl);
$homePage = HomePage::openBy($I);
$homePage->loginAsAdmin();
$I->see('46');
$I->click('New person achievement');

$I->selectOption('form select[name="PersonAchievement[person_id]"]', 1);
$I->selectOption('form select[name="PersonAchievement[achievement_id]"]', 1);
$I->click('Save');
$I->see('success');

$I->see(46 + 11);

$I->click("Alice Smith");

$today = date("Y-m-d");

$I->see('46');
$I->see('11');
$I->see($today);

$I->click('(//a[@title="Delete"])[1]');
$I->dontSee('12');
$I->see('46');

$I->click("Chopin");
$I->see('46');

