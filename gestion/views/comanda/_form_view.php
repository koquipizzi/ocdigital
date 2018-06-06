<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;


/* @var $this yii\web\View */
/* @var $model app\models\Comanda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comanda-form">
<?php $form = ActiveForm::begin(); ?>
  <div class="col-md-6">
	  <?= $form->field($model, 'fecha_produccion')->widget(DateControl::className(),
		  [
			  'value' => $model->fecha_produccion,
			  'language' => 'es',
			  'readonly' => true,
			  'type'=>DateControl::FORMAT_DATETIME,
		  ]); ?>
  </div>
  <div class="col-md-6">
      <?= $form->field($model, 'nota')->textarea(['rows' => '1','readOnly'=> true]) ?>
  </div>
    <?php ActiveForm::end(); ?>
</div>
