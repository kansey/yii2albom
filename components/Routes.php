<?php
namespace app\components;
use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;


/**
* 
*/
class Routes extends Component
{
	
	public $url;
	public $upload;


	public function init()
	{
		$this->url    = 'http://localhost'.Yii::getAlias('@web/images/store/');
		$this->upload = 'images/store/';
		parent::init();
	}


	public function getRouteWeb()
	{
		return $this->url;
	}


	public function setRouteWeb($newUrl)
	{
		$this->url = $newUrl;
	}


	public function getRouteUpload()
	{
		return $this->upload;
	}


	public function setRouteUpload($newUpload)
	{
		$this->upload = $newUpload;
	}

}