<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use app\models\ImageForm;
use app\models\Albom;
use app\models\Images;


/**
*
* ImageController implements the create, delete, edit and show actions for 
* models Images, ImageForm and Albom
*   
*/
class ImageController extends Controller
{
	
/**
 * Creates a new ImageForm model.
 *
 * @return mixed
*/
    public function actionCreate()
    {
        $model = new ImageForm();
                       
        if (Yii::$app->request->isPost) {

            $model->image = UploadedFile::getInstance($model, 'image');

            if ($model->upload()) {

                return $this->goHome();
            }
        }

        return $this->render('create', ['model' => $model]);
    } //end actionCreate()


/**
 * Displays a  model Albomd if data model Images loaded, else displays model 
 * ImageForm
 *
 * @return mixed
*/
    public function actionShow()
    {
        $model = new Images();
        
        if ($model->find()->one()) {

            return $this->render('view', ['model' => new Albom()]);
        } 
        else {
            $this->redirect(\Yii::$app->urlManager->createUrl("image/create"));
        }
    } //end actionShow()


/**
 *  Displays a  view _forms if data model Images loaded, else displays view
 *  create
 *
 * @return mixed
*/
     public function actionEdit()
    {
        $model = new Images();

        if ($model->find()->one()) {

            return $this->render('_forms', ['model' => new Albom()]);
        } 
        else {
        	$this->redirect(\Yii::$app->urlManager->createUrl("image/create"));
        }    
    } //end actionEdit()


/**
 * Deletes an existing Images model.  
 *
 * @param string $url
 *
 * @return mixed
*/
    public function actionDelete($url)
    {
        $model = Images::find()->where(['url'=>$url])->one();
        
        $path = Yii::$app->route->getRouteUpload() . $model->base_name . '.' . $model->extension;
               
        if (unlink($path)) {
            $model->delete();
        }
      
        return $this->goHome();
    }  //end actionDelete()  

} //end class