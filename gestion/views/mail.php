<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Mail */
/* @var $form ActiveForm */
?>
<div class="mail">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'accion') ?>
        <?= $form->field($model, 'mails') ?>
    
        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- mail -->
