<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * LoginForm is the model behind the login form.
*/
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


/**
 * @return array the validation rules.
*/
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    } //end rules()

/**
 * Validates the password.
 * This method serves as the inline validation for password.
 *
 * @param string $attribute the attribute currently being validated
 * @param array $params the additional name-value pairs given in the rule
*/
   
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    } //end validatePassword()

/**
 * Logs in a user using the provided username and password.
 * @return boolean whether the user is logged in successfully
*/
    public function login()
    {
        if ($this->validate()) {
           
            $user = new User();
            $tocken = $user->getTocken($this->username);
            $cookies = Yii::$app->response->cookies;
            $cookies->add(new \yii\web\Cookie([
                'name' => 'user',
                'value' => "$tocken",
            ]));           
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        else {
            return false;
        }
    } //end login()

/**
 * Finds user by [[username]]
 *
 * @return User|null
*/
    public function getUser()
    {
        if ($this->_user === false) {
            
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    } //end getUser)

} //end class
