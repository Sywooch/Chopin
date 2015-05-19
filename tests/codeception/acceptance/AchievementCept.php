<?php

use tests\codeception\_pages\HomePage;
use tests\codeception\_pages\AchievementPage;

$I = new AcceptanceTester($scenario);
$I->wantTo('perform CRUD actions');

$I->amOnPage(Yii::$app->homeUrl);
$homePage = HomePage::openBy($I);
$homePage->loginAsAdmin();
$I->click('Achievements');
$I->see('Achievements', 'h1');

$achievementPage = new AchievementPage($I);

$I->amGoingTo("create a achievement");
$I->click('New achievement');
$I->see('New achievement', 'h1');

$achievementPage->fillForm('', '', 1);
$I->see('Name cannot be blank.', '.help-block');

$achievementPage->fillForm('Peny achievement', '', 1);
$I->see('must be greater');

$achievementPage->fillForm('Peny achievement', '2345', 1);
$I->see('must be less');

$achievementPage->fillForm('Peny achievement', '2', 1);
$I->see('success');
$I->see('Peny achievement');

$I->click('Peny achievement');
$I->see('Editing achievement', 'h1');
$I->seeInField('input[name="Achievement[name]"]', 'Peny achievement');
$I->seeInField('input[name="Achievement[reward]"]', '2');
$I->seeInField('input[name="Achievement[repeatable]"]', '1');

$achievementPage->fillForm('Large achievement', '98', 1);
$I->see('success');
$I->see('Large achievement');

$I->click('(//a[@title="Delete"])[2]');
$I->see('success');
$I->dontSee('Large achievement');
