
<?php

use yii\helpers\Html;
use kartik\datecontrol\DateControl;
use yii\bootstrap\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Producto;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Cliente;
use yii\web\JsExpression;
use yii\helpers\Url;
use \app\models\Unidad;


/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
/* @var $form yii\widgets\ActiveForm */

$js = <<<JS
  
  jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
    
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

  if (! confirm("Está seguro que desea eliminar el producto del pedido?")) {
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

  var formatPenerima = function (penerima) {
      if (penerima.loading) {
          return penerima.nombre;
      }
      var markup =
      '<div class="row">' +
          '<div class="col-sm-5">' +
              '<b style="margin-left:5px">' + penerima.nombre + '</b>' +
          '</div>' +
          '<div class="col-sm-3"><i class="fa fa-code-fork"></i> ' + penerima.nombre + '</div>' +
          '<div class="col-sm-3"><i class="fa fa-star"></i> ' + penerima.id + '</div>' +
      '</div>';
      return '<div style="overflow:hidden;">' + markup + '</div>';
  };

  var formatPenerimaSelection = function (penerima) {
      return penerima.nombre || penerima.id;
  }
JS;

$this->registerJs($js);

$js2 = <<<JS
  var formatPenerima = function (penerima) {
      if (penerima.loading) {
          return penerima.nombre;
      }
      var markup =
      '<div class="row">' +
          '<div class="col-sm-5">' +
              '<b style="margin-left:5px">' + penerima.nombre + '</b>' +
          '</div>' +
          '<div class="col-sm-3"><i class="fa fa-code-fork"></i> ' + penerima.nombre + '</div>' +
          '<div class="col-sm-3"><i class="fa fa-star"></i> ' + penerima.id + '</div>' +
      '</div>';
      return '<div style="overflow:hidden;">' + markup + '</div>';
  };
  var formatPenerimaSelection = function (penerima) {
      return penerima.nombre || penerima.id;
  }
JS;

$this->registerJs($js2, \yii\web\View::POS_HEAD);

$resultsJs = <<< JS
  function (data, params) {
     params.page = params.page || 1;
      return {
          results: data.results
      };
  }
JS;

$updatePedido = <<<JS
  $( document ).ready(function() {
    var id = 0;
    id = $('#pedido-cliente_id').val();
    $("#clienteID").val(id);
  });
JS;
$this->registerJs($updatePedido);

$this->registerJs('var ajaxurl = "' .Url::to(['pedido/get-cliente-direccion']). '";', \yii\web\View::POS_HEAD);
$this->registerJs('var ajaxurlp = "' .Url::to(['producto/get-detalles']). '";', \yii\web\View::POS_HEAD);
$this->registerJs('var linea = "' .Url::to(['producto/get-detalles']). '";', \yii\web\View::POS_HEAD);

$set_date = <<<JS
 $( document ).ready(function() {
     if (!$('#pedido-fecha_entrega-disp').val()){
         if ($('#pedido-fecha_entrega').val()){
            b = $('#pedido-fecha_entrega').val();
            var d = new Date(b);
            day = '' + d.getDate();
            month = '' + (d.getMonth() + 1);
            if (day.length < 2) day = '0' + day;
            if (month.length < 2) month = '0' + month;
            var date = day+ '/' + month + '/' + d.getFullYear();
            $('#pedido-fecha_entrega-disp').val(date);
         }
     }
 });
JS;

$this->registerJs($set_date);

?>

<div class="pedido-form">

  <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>
  <input id="clienteID" name="clienteID" type="hidden" value="xm234jq">
  <div class="row">
    <div class="col-sm-6">
        <?php
            $clientes = Cliente::find()->all();
            $listData = ArrayHelper::map($clientes,'id', 'nombre');
            echo $form->field ($model, 'cliente_id', ['template' => "{label} {input} {hint} {error}"]
                            )->widget(select2::classname(), [
                                                                'data' => $listData ,
                                                                'language' => 'es',
                                                                'options' => [
                                                                  'onchange' => '
                                                                        jQuery("#clienteID").val(this.value);
                                                                        id = this.value;
                                                                        aux = ajaxurl + "&id=" + id;
                                                                        $.get( aux , function( data ) {
                                                                            if (data.rta){
                                                                                jQuery("#pedido-ship_address_1").val(data.results.direccion);
                                                                                jQuery("#pedido-responsable_recepcion").val(data.results.contacto);
                                                                                jQuery("#pedido-telefono").val(data.results.telefono);
                                                                                jQuery("#pedido-hora_de_recepcion").val(data.results.hora_reparto);
                                                                            }
                                                                        });',
                                                                  'placeholder' => 'Seleccione un Cliente...'],
                                                                'pluginOptions' => [
                                                                   'allowClear' => false
                                                               ],
                                                            ]);
        ?>
    </div>
      <div class="col-md-6">
        <?= $form->field($model, 'fecha_entrega')->widget(DateControl::className(),
        [
            'options' => ['placeholder' => 'Seleccione fecha de Entrega ...'],
            'value' => $model->fecha_produccion,
            'type'=>DateControl::FORMAT_DATE,
            'language' => 'es',
            'pluginOptions' => [
                'autoclose'=>true,
                'convertFormat' => true,
                'format' => 'dd-m-yyyy hh:ii',
                'todayHighlight' => true,
            ]
        ]); ?>
    </div>
  </div>
  <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'ship_city')->textInput(['maxlength' => true,'value' => 'Buenos Aires']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'ship_postcode')->textInput(['maxlength' => true,'value' => 'C1010']) ?>
        </div>
         <div class="col-sm-4">
            <?= $form->field($model, 'ship_address_1')->textInput(['maxlength' => true]) ?>
        </div>
  </div>
  <div class="row">
      <div class="col-sm-8">
          <?= $form->field($model, 'cond_venta')->textarea(['maxlength' => true,]) ?>
      </div>
      
      <div class="col-sm-4">
          <?= $form->field($model, 'responsable_recepcion')->textInput(['maxlength' => true,]) ?>
      </div>
  </div>
    <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'telefono')->textInput(['maxlength' => true,]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'notas')->textInput(['maxlength' => true,]) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'hora_de_recepcion')->textInput(['maxlength' => true,]) ?>
        </div>
    </div>
        <?php DynamicFormWidget::begin([
            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
            'widgetBody' => '.container-items', // required: css class selector
            'widgetItem' => '.item', // required: css class
            'limit' => 900, // the maximum times, an element can be cloned (default 999)
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
                        <div class="col-sm-4">
                        <?php
                            $productos = Producto::find()->all();
                            $listData =ArrayHelper::map($productos,'id', 'nombre');
         //      var_dump($productos);die;
                            $url = Url::toRoute('pedido/productos-por-cliente');
                            echo $form->field ($modelPedidoDetalle, "[{$index}]producto_id", ['template' => "{label} {input} {hint} {error}"]
                                              )->widget(select2::classname(),
                                              [
                                              'data' => $listData,
                                           //   'language' => 'es',
                                              'options' => ['placeholder' => 'Seleccione Producto...'],
                                              'pluginOptions' => [
                                                    'allowClear' => false,
                                                    'ajax' => [
                                                        'url' => $url,
                                                        'dataType' => 'json',
                                                        'data' => new JsExpression('function(params) {
                                                            var data; data = jQuery("#clienteID").val();
                                                            return {clienteId:data, q:params.term};
                                                        }'),
                                                        'processResults' => new JsExpression($resultsJs),
                                                        'results' => new JsExpression($resultsJs),
                                                    //    'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                                  ],
                                              ]       ,
                                                'options' => [
                                                    'onchange' => "
                                                        var idProducto = $(this).val();
                                                        url = ajaxurlp+'&id='+idProducto;
                                                        $.get( url , function( data ) {
                                                            if (data.rta){
                                                                $('#pedidodetalle-'+linea+'-precio_unitario').val(data.data.precio_unitario);
                                                                $('#pedidodetalle-'+linea+'-unidad_id').val(data.data.unidad_id);
                                                            }
                                                        });"
                                              ],
                                              ]);
                          ?>
                          </div>
                          <div class="col-sm-2">
                              <?= $form->field($modelPedidoDetalle, "[{$index}]cantidad")->textInput(['type' => 'number','integerOnly'=>true,]) ?>
                          </div>
                          <div class="col-sm-3">
                          <?php
                              $clientes = Unidad::find()->all();
                              $listData = ArrayHelper::map($clientes,'id', 'nombre_unidad');
                              echo $form->field($modelPedidoDetalle, "[{$index}]unidad_id")->dropDownList($listData, ['prompt' => 'Seleccione Unidad' ]);
                             /* echo $form->field ($modelPedidoDetalle, "[{$index}]unidad_id")->widget(select2::classname(), [
                                  'data' => $listData ,
                                  'options' => ['placeholder' => 'Seleccione Unidad...'],
                              ]);*/
                          ?>
                          </div>
                          <div class="col-sm-2">
                              <?= $form->field($modelPedidoDetalle, "[{$index}]precio_unitario")->textInput(['type' => 'float']) ?>
                          </div>
                        
                      </div>
                    </div>
                  </div>
                    <?php endforeach; ?>
            </div>
        </div>
        <div class="form-group" style="float:right;">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
        </div>

        <?php DynamicFormWidget::end(); ?>
    <?php ActiveForm::end(); ?>
</div>
