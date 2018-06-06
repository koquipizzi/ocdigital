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
        'options' => ['placeholder' => 'Seleccione fecha de Entrega ...'],
        // 'type' => DateControl::TYPE_COMPONENT_PREPEND,
        'value' => $model->fecha_produccion,
        'language' => 'es',
        'type'=>DateControl::FORMAT_DATETIME,
        'pluginOptions' => [
            'autoclose'=>true,
            'convertFormat' => true,
            'format' => 'dd-m-yyyy hh:ii',
            'todayHighlight' => true,
        ]
     ]); ?>
  </div>

  <div class="col-md-6">
      <?= $form->field($model, 'nota')->textarea(['rows' => '1','readOnly'=> false]) ?>
  </div>

  <div class="" style="float:right;">
      <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
      <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
  </div>

    <?php ActiveForm::end(); ?>

</div>
