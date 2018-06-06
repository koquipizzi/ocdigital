<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Categoria;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

      <?php $form = ActiveForm::begin(); ?>


        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

        <?php
         $categorias = Categoria::find()->all();
         $listData = ArrayHelper::map($categorias,'id', 'nombre');

        echo $form->field ($model, 'categoria_id', ['template' => "{label} {input} {hint} {error}"]
                          )->widget(select2::classname(), [
                                                            'data' => $listData ,
                                                            'language' => 'es',
                                                            'options' => ['placeholder' => 'Seleccione una Categoria...'],
                                                            'pluginOptions' => [
                                                                'allowClear' => false
                                                            ]
                                                          ]);

        ?>

        <?= $form->field($model, 'precio_unitario')->textInput(['type' => 'real']) ?>

      <div class="form-group" style="float:right;">
          <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
          <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
      </div>



</div>


    <?php ActiveForm::end(); ?>

</div>
