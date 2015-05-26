<?php

use tests\codeception\_pages\HomePage;

$I = new AcceptanceTester($scenario);
$I->wantTo('confirm achievement complete');

$I->amOnPage(Yii::$app->homeUrl);
$homePage = HomePage::openBy($I);
$homePage->loginAsSecondAdmin();
$I->see('Logout (bob)');
$I->see('46');
$I->click('New group achievement');

$I->selectOption('form select[name="GroupAchievementForm[persons][1]"]', 1);
$I->selectOption('form select[name="GroupAchievementForm[persons][2]"]', 2);
$I->selectOption('form select[name="GroupAchievementForm[achievement_id]"]', 1);

$achievement_date = '2015-05-01 16:35';

$I->fillField('input[name="GroupAchievementForm[date]"]', $achievement_date);
$I->click('Save');
$I->see('success');

$I->see(46 + 11);
$I->see(11);

$I->click("Alice Smith");

$I->see('46');
$I->see('11');
$I->see($achievement_date);
$I->see('Bob Dow');

$I->click('(//a[@title="Delete"])[1]');
$I->dontSee('12');
$I->see('46');

$I->click("Chopin");
$I->see('46');

