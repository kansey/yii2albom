<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Images;
use yii\helpers\ArrayHelper;
use zyx\widgets\ImageX;
use yii\imagine\Image;
use yii\bootstrap\ActiveForm;

$this->title = 'Photo Gallery';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('css/bootstrap.css');
$this->registerCssFile('css/bootstrap-responsive.css');


?>

<div class="site-contact">
   <div>
      <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
<?php
    $img = $model->getImages();
    //var_dump($img);
    $ids = ArrayHelper::getColumn($img, 'url');

?>
<?php  $items = []; ?>
<table class="table table-striped" align="center">
  <tr>
    <td>Create new image</td>
    <td>Delete current image</td>
    <td>Upload images</td>
  </tr>
  <?php foreach ($ids as $image): ?>
  <tr> 
    <td>
      <?= Html::a('create', ['create'], 
      [
        'class' => 'btn btn-primary',
        'data'  => [
          'confirm' => 'Are you sure you want to create new image?',
      ],
    ]) ?>
    </td>
    <td>
      <?= Html::a('Delete', ['delete', 'url' => $image], 
      [
        'class' => 'btn btn-danger',
        'data'  => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
      ],
    ]) ?>
    </td>
    <td>
    <?php 
    echo ImageX::widget([

      'src' => $image, 
      'options' => ['width' => 50, 'height' => 50], 
      'og' => [['enable' => false]],
      'md' => ['enable' => false] 
                 
    ]);?>
    </td>
   </tr> 
<?php endforeach; ?>
</table>
</div>


