<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;
use yii\base\Model;
use app\models\Images;


/**
 * ImageForm model
 *  
 * @property file $image
*/
class ImageForm extends Model
{
	public $image;


/**
 * @inheritdoc
*/
	public function rules()
	{
		return [
		  [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg,jpeg,gif'],
		];
	} //end rules()

/**
 * Upload images to the server and the database
 *
 * @return boolean true 
*/

   public function upload()
   {
	    if ($this->validate()) {
            
            	$this->image->saveAs('images/store/' . $this->image->baseName . '.' . $this->image->extension);
                     
            	if ($this->saveImgInDB()) {
            	
            		return true;
            	} 
            } 
    } //end upload()


/**
 *  Saves the image information in the database
 *
 * @return mixed
*/
   public function saveImgInDB()
    {
    	$modelImages = new Images();
    	$cookies     = Yii::$app->request->cookies;
        $tocken      = $cookies->getValue('user');
        $url         = Yii::$app->route->getRouteWeb().$this->image->baseName.'.'.$this->image->extension;
        
        $values = [
            'tocken'    => $tocken,
            'url'       => $url,
            'base_name' => $this->image->baseName,
            'extension' => $this->image->extension,
        ];
        $modelImages->attributes = $values;
       
        return ($modelImages ->save() ? true : false); 
   } //end saveImgInDB()

} //end class
