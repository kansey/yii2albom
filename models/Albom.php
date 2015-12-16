<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use app\models\Images;



/**
 * Albom model
 * 
*/
class Albom extends Model
{
	

/**
 * Get the picture is uploaded by user
 *
 * @return mixed 
*/
	public function getImages()
	{
		$listImages = Images::find()
			->select('url')
			->where(['tocken' => $this->getTockenUser()])
			->asArray()
			->all();

		return $listImages;
	} //end getImages()
	

/**
 * Get id the user of cookie
 *
 * @return mixed
*/
	public function getTockenUser()
	{
		$cookies = Yii::$app->request->cookies;
                return $cookies->getValue('user');
	} //end getIdUser()


/**
 *  Get mode User with tocken
 * 
 * @return mixed
*/
	public static function getUser()
	{
		$model  = new Albom();
		$tocken = $model->getTockenUser();
		$user   = User::findOne(['tocken' => $tocken]);
		
		return [
			'login' => $user->login,
			'email' => $user->email
		];
	}

} //end class
