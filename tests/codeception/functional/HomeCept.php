<?php

/* @var $scenario Codeception\Scenario */

$I = new FunctionalTester($scenario);
$I->wantTo('ensure that home page works');
$I->amOnPage(Yii::$app->homeUrl);
$I->see('My Company');

$I->seeLink('Home');
$I->click('Home');
$I->see('Congratulations');

$I->seeLink('SignUp');
$I->click('SignUp');
$I->see('Signup');

$I->seeLink('Login');
$I->click('Login');
$I->see('Login');