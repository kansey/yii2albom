<?php
namespace tests\codeception\unit\models;

use Yii;
use yii\codeception\TestCase;
use app\models\SignupForm;
use Codeception\Specify;


class SignupFormTest extends TestCase
{
    public function testCorrectSignup()
    {
        $model = new SignupForm([
            'login'          => 'some_username',
            'password'       => 'some_password',
            'repeatPassword' => 'some_password',
            'email'          => 'some_email@example.com',
        ]);
        
        $user = $model->signup();
        $this->assertInstanceOf('app\models\User', $user, 'user should be valid');
        expect('username should be correct', $user->login)->equals('some_username');
        expect('email should be correct', $user->email)->equals('some_email@example.com');
        expect('password should be correct', $user->validatePassword('some_password'))->true();
        //$user->findOne(['login' => 'some_username'])->delete();
    }


    public function testNotCorrectSignup()
    {
        $model = new SignupForm([
            'login'          => 'troy.becker',
            'password'       => 'some_password',
            'repeatPassword' => 'some_password',
            'email'          => 'nicolas.dianna@hotmail.com',
        ]);
        
        expect('username and email are in use, user should not be created', $model->signup());
    }

}