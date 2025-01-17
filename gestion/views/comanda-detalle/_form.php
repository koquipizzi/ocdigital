<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ComandaDetalle */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="comanda-detalle-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'cantidad_produccion')->textInput() ?>

    <?= $form->field($model, 'comanda_id')->textInput() ?>

    <?= $form->field($model, 'producto_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
