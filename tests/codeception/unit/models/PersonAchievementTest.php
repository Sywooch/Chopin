<?php

namespace tests\codeception\unit\models;

use Yii;
use yii\codeception\TestCase;
use app\models\PersonAchievement;

class PersonAchievementTest extends TestCase {

    protected function setUp() {
        parent::setUp();
    }

    public function testGetTop5() {
        $top5 = PersonAchievement::getTop5();

        $this->assertEquals(5, count($top5));
    }

}
