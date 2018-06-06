<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Pedido;
use yii\helpers\Url;
use eleiva\noty\Noty;
use yii\widgets\Pjax;
use xj\bootbox\BootboxAsset;
BootboxAsset::register($this);

/* @var $this yii\web\View */
/* @var $model app\models\Comanda */

$this->title = Yii::t('app', 'Detalle de Comanda '). $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comandas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Detalle');
?>
<div class="comanda-update">
<?php
$js = <<<JS
 $('.ajaxDelete').on('click', function(e) {
      e.preventDefault();
      var deleteUrl = $(this).attr('delete-url');
      var pjaxContainer = $(this).attr('pjax-container');
          bootbox.confirm('Esta seguro que desea borrar este pedido? ',
                  function(result) {
                          if(result) {
                                  $.ajax({
                                          url: deleteUrl,
                                          type: 'post',
                                          error: function(xhr, status, error) {
                                              alert('Ocurrio un problema.' + xhr.responseText);
                                          }
                                          }).done(function(data) {
                                                      $.pjax.reload({container: '#' + $.trim(pjaxContainer)});
                                                      var obj = $.parseJSON(data);
                                                      if (obj.error) {
                                                        var n = noty({
                                                            text: obj.mensaje,
                                                            type: "warning",
                                                            class: "animated pulse",
                                                            layout: "topCenter",
                                                            theme: "metroui",
                                                            timeout: 4000,
                                                            force: false,
                                                            modal: false,
                                                        });
                                                      }else{
                                                        var n = noty({
                                                            text: obj.mensaje,
                                                            type: "success",
                                                            class: "animated pulse",
                                                            layout: "topCenter",
                                                            theme: "metroui",
                                                            timeout: 4000,
                                                            force: false,
                                                            modal: false,
                                                        });
                                                      }
                                              });
                          }
                  }
          );
    });

$(document).on('ready pjax:success', function() {
    $('.ajaxDelete').on('click', function(e) {
      e.preventDefault();
      var deleteUrl = $(this).attr('delete-url');
      var pjaxContainer = $(this).attr('pjax-container');
          bootbox.confirm('Esta seguro que desea borrar este pedido? ',
                  function(result) {
                          if(result) {
                                  $.ajax({
                                          url: deleteUrl,
                                          type: 'post',
                                          error: function(xhr, status, error) {
                                              alert('Ocurrio un problema.' + xhr.responseText);
                                          }
                                          }).done(function(data) {
                                                      $.pjax.reload({container: '#' + $.trim(pjaxContainer)});
                                                      $.pjax.reload({container: '#detalle'});
                                                      var obj = $.parseJSON(data);
                                                      if (obj.error) {
                                                        var n = noty({
                                                            text: obj.mensaje,
                                                            type: "warning",
                                                            class: "animated pulse",
                                                            layout: "topCenter",
                                                            theme: "metroui",
                                                            timeout: 4000,
                                                            force: false,
                                                            modal: false,
                                                        });
                                                      }else{
                                                        var n = noty({
                                                            text: obj.mensaje,
                                                            type: "success",
                                                            class: "animated pulse",
                                                            layout: "topCenter",
                                                            theme: "metroui",
                                                            timeout: 4000,
                                                            force: false,
                                                            modal: false,
                                                        });
                                                      }
                                              });
                          }
                  }
          );
    });
  });
JS;
$this->registerJs($js);
?>
  <div class="box box-info">
    <div class="box-body">
        <?= $this->render('_form_view', [
            'model' => $model,
        ]) ?>
    </div>
    <div class="box-footer">
      <div class="pull-right">
        <?= Html::a(Yii::t('app', 'Imprimir Produccion'), ['imprimircat-comandas', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Imprimir Pedidos'), ['imprimir-comandas', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
          <?= Html::a(Yii::t('app', 'Logistica'), ['view-pedidos', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      </div>
    </div>

  </div>

  <?php Pjax::begin(['id' => 'pedidos']); ?>
  <div class="row">
    <div class="col-md-6">
        <div class="box box-info">
          <div class="box-header with-border">
              <h3 class="box-title">Detalles Productos en Comanda</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
              </div>
          </div>
          <div class="box-body">
            <?= GridView::widget(['dataProvider' => $dataProvider,  'columns' => [
                'cantidad_produccion',
                ['attribute' => 'Producto','value' => 'producto.nombre'],
                ['attribute' => 'Categoria','value' => 'producto.categoria.nombre'],
            ] ]);?>
          </div>
        </div>
    </div>
    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Pedidos de la Comanda</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
          <?= GridView::widget([
              'dataProvider' => $dataProviderPedido,
              'columns' => [
                              [
                               'label' => 'Pedido Nro',
                               'attribute' => 'id',
                               'headerOptions' => ['style' => 'width:8%'],
                               'format' => 'raw',
                               'value'=>function ($data) {
                                   return Html::a(Html::encode($data['id']),Url::to(["pedido/view/", 'id' => $data['id']]));
                               },
                              ],
                              [
                                'label' => 'Fecha Hora',
                                'attribute' => 'fecha_hora',
                                'format' => ['date', 'php:d/m/Y  H:i'],
                              ],
                              [
                                'label' => 'Razon Social / Nombre',
                                'value' => function($model){
                                     return $model->getClienteRazonSocial();
                                },
                              ],
                              [
                              'label' => 'Precio Total',
                              'attribute' => 'precio_total',
                              'format' => ['currency'],
                              'contentOptions' => ['class' => 'text-right'],
                              'headerOptions' => ['class' => 'text-right']
                              ],
                              [
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{quitar}',
                                'contentOptions' => ['style' => 'width:8%'],
                                'buttons' => [
                                              'quitar' => function ($url, $model) {
                                                return Html::a('<span class="fa fa-trash"></span>', false,
                                                [
                                                  'class' => 'ajaxDelete',
                                                  'delete-url' => $url,
                                                  'pjax-container' => 'pedidos',
                                                  'title' => Yii::t('app', 'Quitar')
                                                ]
                                                );}
                                             ],
                                'urlCreator' => function ($action, $model, $key, $index) {
                                    if ($action === 'quitar') {
                                        $url = Url::to(["pedido/quitar-comanda", 'id' => $model->id]);
                                        return $url;
                                        }
                                    }
                              ],
                            ]]);?>
          </div>
        </div>
      </div>
    </div>
  <?php Pjax::end(); ?>
</div>
