<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Images;
use yii\helpers\ArrayHelper;
use zyx\widgets\ImageX;
use yii\imagine\Image;

$this->title = 'Photo Gallery';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="site-contact">
 <div>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
</div>
  
<?php

    $img   = $model->getImages();
    $ids   = ArrayHelper::getColumn($img, 'url');
    $items = [];
?>

<?php foreach ($ids as $image): ?>
<?php 
	$item = [
		'url'     => $image,
    'src'     => $image,
    'options' => array('title' => 'Image')
  ];
    
  array_push($items, $item);
?>
<?php endforeach; ?>

<?= dosamigos\gallery\Carousel::widget([
    'items' => $items, 
    ]); ?>
</div>