<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;

?>

<div class="confirmar-form">

  <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
  <div class="box-body">
      <div class="row">
          <div class="col-md-6">
              <?= $form->field($model, 'fecha_entrega')->widget(DateControl::className(),
                  [
                      'options' => ['placeholder' => 'Seleccione fecha de Entrega ...'],
                      'value' => $model->fecha_produccion,
                      'language' => 'es',
                      'type'=>DateControl::FORMAT_DATETIME,
                      'pluginOptions' => [
                          'autoclose'=>true,
                          'convertFormat' => true,
                          'format' => 'dd-m-yyyy hh:ii',
                          'todayHighlight' => true,
                      ]
                  ]);
              ?>
          </div>
          <div class="col-md-6">
              <?= $form->field($model, 'facturable')->dropdownList([1 => 'Si', 2 => 'No']); ?>
          </div>
      </div>
      <div class="row">
          <div class="col-md-6">
              <?= $form->field($model, 'flete_bonificado')->dropdownList([1 => 'Si', 2 => 'No']); ?>
          </div>
          <div class="col-md-6">
              <?= $form->field($model, 'flete_valor')->textInput(['type' => 'number']) ?>
          </div>
      </div>

    <div class="form-group" style="float:right;">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Confirmar') : Yii::t('app', 'Confirmar'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

  </div>

  <?php ActiveForm::end(); ?>

</div>
