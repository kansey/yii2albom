<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\User;


/*
 * This is the model class for table "images"
 *
 * @property integer $id_image 
 * @property integer $id_user
 * @property string  $url
 * @property string  $base_name
 * @property string  $extenstion
*/
class Images extends ActiveRecord
{

/**
 * @inheritdoc
*/
	public static function tableName()
	{
		return '{{%images}}';
	} //end tableName()


/**
 *  @return array the validation rules.
*/
	public function rules()
	{
		return [
			[['id_image'],'integer'],
			[['url', 'base_name', 'extension','tocken'], 'string', 'max' => 255 ],
		];
	} //end rules()


/**
 *  
 *
 * @return mixed
*/
	public function getUsers()
	{
		return $this->hasOne(User::className(), ['tocken' => 'tocken']);
	} //end getUsers()
		
} //end class