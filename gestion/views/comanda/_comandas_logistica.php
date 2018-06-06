<?php
use yii\helpers\Html;
use app\models\Pedido;
use yii\grid\GridView;
use app\models\Categoria;
use app\models\ComandaDetalleSearch;
use yii\helpers\Url;
use eleiva\noty\Noty;
use yii\widgets\Pjax;
use kartik\editable\Editable;
use kartik\spinner\Spinner;
use xj\bootbox\BootboxAsset;
BootboxAsset::register($this);

$this->title = Yii::t('app', "Logística de Envíos ");
?>
<div class="cliente-index">
  <div class="box box-warning with-border">
    <div class="box-header">
      <?= Html::encode(Yii::t('app', 'Logística de Pedidos')) ?> - Comanda Nro: <?= $model->id ?>
      <div class="pull-right">
          <?= Html::a(Yii::t('app', 'Imprimir'), ['imprimir-logistica', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
      </div>
    </div>
  <div class="box-body">
    <?php Pjax::begin(['id' => 'pedidos']); ?>
          <?= GridView::widget([
          'dataProvider' => $dataProviderPedido,
          'columns' => [['class' => 'yii\grid\CheckboxColumn','checkboxOptions' => function($model, $key, $index, $widget) {
                                                        return ['value' => $model['id'] ];
                                                      },],
                                                    ['class' => 'yii\grid\ActionColumn',
              'template' => '{view} {delete}',
                                    'buttons' => [
                                                    'view' => function ( $model, $data) { 
                                                                    return Html::a('<span class="glyphicon glyphicon-arrow-up subir_entrega" data-id="'.$data['orden_reparto'].'" data-comanda="'.$data['comanda_id'].'"></span>', '#', ['title' => Yii::t('app', 'Subir'),]);
                                                            },
                                                    'delete' => function ($model, $data) {
                                                                    return  Html::a('<span class="glyphicon glyphicon-arrow-down bajar_entrega" data-id="'.$data['orden_reparto'].'" data-comanda="'.$data['comanda_id'].'"></span>', '#', ['title' => Yii::t('app', 'Bajar'), 'data-ajax' => '1']);
                                            }
                                    ],
                'headerOptions' => ['style' => 'width:7%'],
                  'contentOptions' => ['style' => 'max-width:20px;'],
              ],
                          [
                            'label' => 'Nro. Pedido',
                            'attribute' => 'id',
                            'headerOptions' => ['style' => 'width:8%'],
                            'format' => 'raw',
                            'value'=>function ($data) {
                                return Html::a(Html::encode($data['id']),Url::to(["pedido/view/", 'id' => $data['id']]));
                            },
                          ],
                          
                          [
                            'label' => 'Razón Social',
                            'attribute' => 'razon_social',
                            'value' => 'cliente.razon_social'
                          ],
                          [
                            'label' => 'Dirección', 
                            'value' => 'cliente.direccion'
                          ],
                    
                          [
                            'attribute' => 'Hora Entrega',
                            'filter' => false,
                            'format' => 'raw',
                            'value' => function ($model, $data) {
                                $echo = "";
                                $cliente = $model->cliente;
                                $dato = $cliente['hora_reparto'];
                                $form = '<form id="kv-login-form" class="form-vertical" action="/index.php?r=pedido/edit-cliente-hora-entrega">
                                <input type="hidden" name="_csrf" value="jUza6moXT7HDpHpr5H_Y56k_y_IdH0BNh_HshXsWA6f4JoPSLlAV5I_XLCWIKY-uxHCCtXxpOBv-mq-1JE9Z_Q==">
                                <div class="form-group field-mail-mails">';
                                    $editable = Editable::widget([
                                        'name'=>'hora_reparto',
                                        'asPopover' => false,
                                        'value'=>$dato,
                                        'format' => Editable::FORMAT_BUTTON,
                                        'formOptions' => [
                                            'method' => 'post',
                                            'action' => ['pedido/edit-cliente-hora-entrega'] ],
                                        'pluginEvents' => [
                                            'editableSuccess'=>"function(event, val, form, data) { $.pjax.reload({container: '#pedidos'}); }",
                                        ],
                                        'header' => FALSE,
                                        'size'=>'xs',
                                        'options' => ['class'=>'form-control', 'placeholder'=>'Hora Reparto...'],
                                        'afterInput'=>
                                         //       Html::hiddenInput('key',$key).
                                                Html::hiddenInput('id',$model->id),
                                    ]);
                                    return $editable;
                            },
                          ],
                          [
                            'attribute' => 'Contacto',
                            'filter' => false,
                            'format' => 'raw',
                            'value' => function ($model, $data) {
                                $form = '<form id="kv-login-form" class="form-vertical" action="/index.php?r=pedido/edit-cliente">
                                <input type="hidden" name="_csrf" value="jUza6moXT7HDpHpr5H_Y56k_y_IdH0BNh_HshXsWA6f4JoPSLlAV5I_XLCWIKY-uxHCCtXxpOBv-mq-1JE9Z_Q==">
                                <div class="form-group field-mail-mails">';
                          
                                    $editable = Editable::widget([
                                        'name'=>'contacto',
                                        'asPopover' => false,
                                        'value'=>$model['contacto'],
                                        'formOptions' => [
                                            'method' => 'post',
                                            'action' => ['pedido/edit-cliente'] ],
                                        'pluginEvents' => [
                                            'editableSuccess'=>"function(event, val, form, data) { $.pjax.reload({container: '#pedidos'}); }",
                                        ],
                                        'header' => FALSE,
                                        'size'=>'xs',
                                  //     'options' => ['class'=>'form-control', 'placeholder'=>'Cantidad...'],
                                        'afterInput'=>
                                                Html::hiddenInput('id',$model->id),
                                    ]);
                               
                                    return $editable;
                            },
                          ],
                          [
                            'label' => 'Teléfono', 
                            'filter' => false,
                            'format' => 'raw',
                            'value' => function ($model, $data) {
                                $form = '<form id="kv-login-form" class="form-vertical" action="/index.php?r=pedido/edit-telefono">
                                <input type="hidden" name="_csrf" value="jUza6moXT7HDpHpr5H_Y56k_y_IdH0BNh_HshXsWA6f4JoPSLlAV5I_XLCWIKY-uxHCCtXxpOBv-mq-1JE9Z_Q==">
                                <div class="form-group field-mail-mails">';
                                $cliente = $model->cliente;
                          
                                    $editable = Editable::widget([
                                        'name'=>'telefono',
                                        'asPopover' => false,
                                        'value'=>$cliente['telefono'],
                                        'formOptions' => [
                                            'method' => 'post',
                                            'action' => ['pedido/edit-telefono'] ],
                                        'pluginEvents' => [
                                            'editableSuccess'=>"function(event, val, form, data) { $.pjax.reload({container: '#pedidos'}); }",
                                        ],
                                        'header' => FALSE,
                                        'size'=>'xs',
                                       'options' => ['class'=>'form-control', 'placeholder'=>'Teléfono ...'],
                                        'afterInput'=>
                                                Html::hiddenInput('id',$model->id),
                                    ]);
                               
                                    return $editable;
                            },
                          ],
                                                
                          [
                          'label' => 'Total',
                          'attribute' => 'precio_total',
                          'format' => ['currency'],
                          'contentOptions' => ['class' => 'text-right'],
                          'headerOptions' => ['class' => 'text-right']
                          ],
                          
                            ]]);?>
    <?php Pjax::end(); ?>
  </div>
<?php

$this->registerJsFile('@web/js/pedido.js', ['depends' => [yii\web\AssetBundle::className()]]);
?>




