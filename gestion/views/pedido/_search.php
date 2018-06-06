<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PedidoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pedido-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fecha_hora') ?>

    <?= $form->field($model, 'fecha_produccion') ?>

    <?= $form->field($model, 'web_id') ?>

    <?= $form->field($model, 'cliente_id') ?>

    <?php // echo $form->field($model, 'comanda_id') ?>

    <?php // echo $form->field($model, 'precio_total') ?>

    <?php // echo $form->field($model, 'ship_company') ?>

    <?php // echo $form->field($model, 'ship_address_1') ?>

    <?php // echo $form->field($model, 'ship_address_2') ?>

    <?php // echo $form->field($model, 'ship_city') ?>

    <?php // echo $form->field($model, 'ship_state') ?>

    <?php // echo $form->field($model, 'ship_postcode') ?>

    <?php // echo $form->field($model, 'ship_country') ?>

    <?php // echo $form->field($model, 'estado') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
