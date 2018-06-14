<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Categoria;
use app\models\Unidad;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="producto-form">

    <?php $form = ActiveForm::begin(); ?>
    
        <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
    
    <?php
        $unidades = Unidad::find()->all();
        $listData = ArrayHelper::map($unidades,'id', 'nombre_unidad');
        echo $form->field ($model, 'unidad_id', [
            'template' => "{label} {input} {hint} {error}"])->widget(select2::classname(),
            [
                'data' => $listData ,
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccione la Unidad por defecto...'],
                'pluginOptions' => [
                    'allowClear' => false
                ]
            ]);
    ?>

        <?php
         $categorias = Categoria::find()->all();
         $listData = ArrayHelper::map($categorias,'id', 'nombre');

        echo $form->field ($model, 'categoria_id', [
            'template' => "{label} {input} {hint} {error}"])->widget(select2::classname(),
            [
                'data' => $listData ,
                'language' => 'es',
                'options' => ['placeholder' => 'Seleccione una Categoría...'],
                'pluginOptions' => [
                    'allowClear' => false
                ]
            ]);
        ?>

        <?= $form->field($model, 'precio_unitario')->textInput(['type' => 'real']) ?>

        <div class="form-group" style="float:right;">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <a class="btn btn-default" href="<?php echo Url::to(["/producto/index"]) ?>">Cancelar</a>
        </div>



</div>
    <?php ActiveForm::end(); ?>
</div>
