<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Producto;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Cliente;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */

$js = '

        jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
            var linea;
            jQuery(".dynamicform_wrapper .panel-title-producto").each(function(index) {
                linea = index;
                jQuery(this).html("Producto: " + (index + 1))
            });
        });

        jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
            jQuery(".dynamicform_wrapper .panel-title-producto").each(function(index) {
                jQuery(this).html("Producto: " + (index + 1))
            });
        });
';

$this->registerJs($js);

?>

<div class="pedido-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <div class="col-sm-6">
            <?=
            $form->field($model, 'fecha_hora')->widget(DateTimePicker::className(),
            [
                'options' => ['placeholder' => 'Selecione Fecha del pedido','class'=>'form-control'],
                'convertFormat' => true,
                'pluginOptions' => [
                                        'autoclose' => true,
                                        'format' => 'mm/dd/yyyy H:i',
                ]
            ]); ?>
        </div>
        <div class="col-sm-6">
            <?php
            $clientes = Cliente::find()->all();
            $listData = ArrayHelper::map($clientes,'id', 'razon_social');

            echo $form->field ($model, 'cliente_id', ['template' => "{label} {input} {hint} {error}"]
                            )->widget(select2::classname(), [
                                                                'data' => $listData ,
                                                                'language' => 'es',
                                                                'options' => ['placeholder' => 'Seleccione un Cliente...'],
                                                                'pluginOptions' => [
                                                                    'allowClear' => false
                                                                ]
                                                            ]);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'ship_address_1')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'ship_address_2')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'ship_city')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'ship_postcode')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 0, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsPedidoDetalle[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'nombre',
            'cantidad'
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-list-ul"></i> Productos
            <button type="button" class="pull-right add-item btn btn-success btn-xs">
            <i class="fa fa-plus"></i> Agregar Producto</button>
            <div class="clearfix"></div>
        </div>

        <div class="panel-body container-items"><!-- widgetContainer -->
            <?php foreach ($modelsPedidoDetalle as $index => $modelPedidoDetalle): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-producto">Producto : <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$modelPedidoDetalle->isNewRecord) {
                                echo Html::activeHiddenInput($modelPedidoDetalle, "[{$index}]id");
                            }
                        ?>
                        <div class="row">
                                <div class="col-sm-6">
                            <?php
                                $productos = Producto::find()->all();
                                $listData = ArrayHelper::map($productos,'id', 'nombre');

                                echo $form->field ($modelPedidoDetalle, "[{$index}]producto_id", ['template' => "{label} {input} {hint} {error}"]
                                                )->widget(select2::classname(), [
                                                                                    'data' => $listData ,
                                                                                    'language' => 'es',
                                                                                    'options' => ['placeholder' => 'Seleccione Producto...'],
                                                                                    'pluginOptions' => [
                                                                                        'allowClear' => false
                                                                                    ]
                                                                                ]);

                                ?>
                     
                            </div>

                                <div class="col-sm-6">
                                    <?= $form->field($modelPedidoDetalle, "[{$index}]cantidad")->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    
    <?php DynamicFormWidget::end(); ?>





    <?php ActiveForm::end(); ?>

</div>
