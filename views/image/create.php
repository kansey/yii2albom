<?php
use yii\widgets\ActiveForm;

$this->title = 'Create image';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<?= $form->field($model, 'image')->fileInput() ?>
<button class="btn btn-primary">Submit</button>
<?php ActiveForm::end() ?>