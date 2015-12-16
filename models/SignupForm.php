<?php

namespace app\models;

use yii\base\Model;
use app\models\User;

/**
 *  Signup form
*/
class SignupForm extends Model
	{
		public $login;
		public $password;
		public $repeatPassword;
		public $email;

	
/**
 * @return array the validation rules.
*/
	public function rules()
	{
		return [
			[['login','password','repeatPassword','email'],'required'],
			[['login','password','repeatPassword','email'],'trim'],
			['login', 'string', 'min' => 2, 'max' => 255],
			['login', 'match', 'pattern' => '/^[a-z]\w*$/i'],
			['password', 'string', 'min' => 6, 'max' => 255],
			['repeatPassword', 'string', 'min' => 6, 'max' => 255],
			['password','compare','compareAttribute'=>'repeatPassword'],
			['email', 'email'],
		];
	} //end rules()

	
/**
 * If these models are valid, then save
 *
 * @return mixed
*/
	public function signup()
	{
		if ($this->validate()) {
			
			$values = [
				'login' => $this->login,
				'email'	=> $this->email,
			];
			
			$user = new User();
			$user->scenario = 'save';
			$user->attributes = $values;
			$user->generateTocken();
			$user->setPassword($this->password);
				
			if ($user->save()) {
				return $user;
			}
		}
			return null;
	} //end signup()

} //end class 	