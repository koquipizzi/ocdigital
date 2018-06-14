<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'allDay')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start')->textInput() ?>

    <?= $form->field($model, 'end')->textInput() ?>

    <?= $form->field($model, 'entrega')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'className')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'editable')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'startEditable')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'durationEditable')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'source')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'backgroundColor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'borderColor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'textColor')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
