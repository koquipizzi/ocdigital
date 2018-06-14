<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use app\models\Producto;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */
/* @var $form yii\widgets\ActiveForm */


$js = <<<JS

        jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
            var linea;
            jQuery(".dynamicform_wrapper .panel-title-producto").each(function(index) {
                jQuery(this).html("Producto: " + (index + 1));
                linea = index;
            });

            var select0 = jQuery(item).find("#select2-pedidodetalle-"+linea+"-producto_id-container").html("Seleccione un Producto...");
            var begin = "pedidodetalle-"+linea;
            jQuery( "*[id^="+begin+"]" ).val( "" );
        });
        jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
            jQuery(".dynamicform_wrapper .panel-title-producto").each(function(index) {
                jQuery(this).html("Producto: " + (index + 1))
            });
        });
        $(".dynamicform_wrapper").on("beforeDelete", function(e, item) {

            if (! confirm("Está seguro que desea eliminar el producto de cliente?")) {
                return false;
            }
            var n = noty({
                text: "Se eliminó el producto.",
                type: "success",
                class: "animated pulse",
                layout: "topCenter",
                theme: "metroui",
                timeout: 2000, // delay for closing event. Set false for sticky notifications
                force: false, // adds notification to the beginning of queue when set to true
                modal: false, // si pongo true me hace el efecto de pantalla gris
         //       maxVisible  : 10
            });
            return true;
        });
JS;

$this->registerJs($js);

?>

<div class="cliente-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'codigo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>
        </div>

    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'razon_social')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-4">
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'email')->input('email') ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'hora_reparto')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'contacto')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php
    DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 999, // the maximum times, an element can be cloned (default 999)
            'min' => 0, // 0 or 1 (default 1)
            'insertButton' => '.add-item', // css class
            'deleteButton' => '.remove-item', // css class
            'model' => $modelsProductos[0],
            'formId' => 'dynamic-form',
            'formFields' => [
                'id',
                'nombre'
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
            <?php foreach ($modelsProductos as $index => $modelProductos): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <span class="panel-title-producto">Producto : <?= ($index + 1) ?></span>
                        <button type="button" class="pull-right remove-item btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (!$modelProductos->isNewRecord) {
                                echo Html::activeHiddenInput($modelProductos, "[{$index}]id");
                            }
                        ?>
                        <div class="row">
                                <div class="col-sm-6">
                            <?php
                                $productos = Producto::find()->all();
                                $listData = ArrayHelper::map($productos,'id', 'nombre');
                                echo $form->field ($modelProductos, "[{$index}]producto_id",['template' => "{label} {input} {hint} {error}"])->widget(select2::classname(), [
                                                                  'data' => $listData ,
                                                                  'language' => 'es',
                                                                  'options' => [
                                                                  'placeholder' => 'Seleccione Producto...',
                                                                  'value' => !empty($modelProductos->id) ? $modelProductos->id : 0
                                                                  ],
                                                                  'pluginOptions' => [
                                                                      'allowClear' => false
                                                                  ]
                                                                ]
                                )->label(false);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
    <div class="form-group" style="float:right;">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?= Html::resetButton('Limpiar', ['class' => 'btn btn-default']) ?>
    </div>

    <?php DynamicFormWidget::end(); ?>
<?php ActiveForm::end(); ?>

</div>
