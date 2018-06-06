<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use jino5577\daterangepicker\DateRangePicker;
use yii\helpers\Url;
use kartik\spinner\Spinner;
use eleiva\noty\Noty;
use app\models\Pedido;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pedidos');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

$script = <<< JS
$('.ocultar input:checkbox').remove();
$(document).on('pjax:complete', function(event) {
        $('.ocultar input:checkbox').remove();
});
$(document).ready(function(){
    $('.wspinner').hide();
    $('.nspinner').click(function(){
        $('.nspinner').hide();
        $('.wspinner').show();
    });

});
JS;
$this->registerJs($script);

if(!empty($info))
{
  if ($info['estado']){
    echo Noty::widget([
      'text' => $info['mensaje'],
      'type' => Noty::SUCCESS,
      'useAnimateCss' => true,
      'clientOptions' => [
          'timeout' => 5000,
          'layout' => 'topCenter',
          'dismissQueue' => true,
          'progressBar'=> true,
          'killer' => true,
          'theme' => 'metroui',
          'animation' => [
              'open' => 'animated bounceInLeft',
              'close' => 'animated bounceOutLeft',
              'easing' => 'swing',
              'speed' => 500
          ]
      ]
  ]);
  }else{
    echo Noty::widget([
      'text' => $info['mensaje'],
      'type' => Noty::ERROR,
      'useAnimateCss' => true,
      'clientOptions' => [
          'timeout' => 2000,
          'layout' => 'topCenter',
          'dismissQueue' => true,
          'theme' => 'metroui',
          'progressBar'=> true,
          'killer' => true,
          'animation' => [
              'open' => 'animated bounceInLeft',
              'close' => 'animated bounceOutLeft',
              'easing' => 'swing',
              'speed' => 500
          ]
      ]
  ]);
  }

} ?>

<div class="pedido-index">
    <?php Pjax::begin(['id' => 'pedidos']); ?>
  <div class="box box-warning with-border">
    <div class="box-header">
      <?= Html::encode(Yii::t('app', 'Listado de Pedidos')) ?>
      <div class="pull-right">
        <?= Html::beginForm(['comanda/get-action'],'post');?>
        <?= Html::submitButton('Agregar Última Comanda', ['name'=> 'alter-comanda','class' => 'btn btn-success']);?>
        <?= Html::submitButton('Nueva Comanda', ['name'=> 'new-comanda', 'class' => 'btn btn-success']);?>
        <?php
          $url = Url::toRoute('sync');
          echo Html::a('Sincronizar Pedidos', '#', [
            'class' => 'btn btn-success nspinner',
            'title' => Yii::t('yii', 'Close'),
                'onclick'=>'
                $.ajax("'.$url.'",  {data: {id: 1},
                  type: "POST",
              }).done(function(data) {
                $(".wspinner").hide();
                $(".nspinner").show();
              });
                ',                         ]);
        ?>
        <?php
          echo '<button style="display:none;" class="btn btn-success wspinner"';
          echo Spinner::widget(['preset' => 'tiny', 'align' => 'left', 'caption' => 'Sincronizando Pedidos &hellip;']);
          echo '</button>';
        ?>
    </div>
    <div class="box-body">
         <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showFooter' => true,
                'footerRowOptions'=>  ['style' => 'text-align: right; font-weight:bold;'],
                'rowOptions'=> function($model){
                        if(!$model->confirmado){
                            return ['class' => 'danger'];
                        }else{
                            return ['class' => 'success'];
                        }
                },
                'columns' => [
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'checkboxOptions' => function($model, $key, $index, $widget) {
                                                        return ['value' => $model['id']];
                                            },
                    'contentOptions' => function($model){
                                               if(!$model->confirmado){
                                                  return ['class' => 'ocultar'];
                                               }else{
                                                  return ['class' => ''];
                                               }
                                           }
                ],
                [
                    'label' => 'Nro. Pedido',
                    'attribute' => 'id',
                    'headerOptions' => ['style' => 'width:1%']
                ],
                [
                    'label' => 'Fecha Hora',
                    'attribute' => 'fecha_hora',
                    'headerOptions' => ['style' => 'width:15%'],
                    'contentOptions' => ['style' => 'width:15%;'],
                    'format' => ['date', 'php:d/m/Y  H:i'],
                    'filter' => DateRangePicker::widget([
                    'template' => '
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                {input}
                            </div>
                        ',
                         'model' => $searchModel,
                         'locale'    => 'es-ES',
                        'attribute' => 'fecha_hora',
                        'pluginOptions' => [
                            'locale'=> [
                                'format'=>'DD/MM/YYYY',
                                'separator'=>' - ',
                                'applyLabel' => 'Seleccionar',
                                'cancelLabel' => 'Cancelar',
                            ],
                            'autoUpdateInput' => false,
                        ]
                    ])
                ],
                [
                    'attribute' => 'ship_address_1',
                    'headerOptions' => ['style' => 'width:20%'],
                    'contentOptions' => ['style' => 'width:20%;'],
                ],
                [
                    'label' => 'Estado',
                    'attribute' => 'estado',
                    'value' => function($data){
                      if ($data->estado == Pedido::ESTADO_PROCESANDO) {
                        return 'Pendiente';
                      }else if ($data->estado == Pedido::ESTADO_COMPLETADO){
                        return 'Completado';
                      }else if ($data->estado == Pedido::ESTADO_CANCELADO){
                        return 'Cancelado';
                      }else{
                        return $data->estado;
                      }
                    }
                ],
                [
                    'label' => 'Fecha de Entrega',
                    'attribute' => 'fecha_entrega',
                    'contentOptions' => ['style' => 'width:10%;'],
                    'format' => ['date', 'php:d/m/Y'],
                    'filter' => DateRangePicker::widget([
                    'template' => '
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                                {input}
                            </div>
                        ',
                         'model' => $searchModel,
                         'locale'    => 'es-ES',
                        'attribute' => 'fecha_entrega',
                        'pluginOptions' => [
                            'locale'=> [
                                'format'=>'DD/MM/YYYY',
                                'separator'=>' - ',
                                'applyLabel' => 'Seleccionar',
                                'cancelLabel' => 'Cancelar',
                            ],
                            'autoUpdateInput' => false,
                        ]
                    ])
                ],
                [
                    'label' => 'Razón Social / Nombre',
                    'attribute' => 'razon_social',
                    'value' => function($model){
                        return $model->getClienteRazonSocial();
                    },
                    'headerOptions' => ['style' => 'width:20%'],
                    'contentOptions' => ['style' => 'width:20px;'],
                ],
                [
                   'label' => 'Total',
                   'attribute' => 'precio_total',
                   'footer' => Pedido::getPTotal($dataProvider->models, 'precio_total'),
                   'format' => ['currency'],
                   'contentOptions' => ['style' => 'text-align: right;'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update} {delete} {confirm} ',
                    'headerOptions' => ['style' => 'width:13%'],
                    'contentOptions' => ['style' => 'width:13px;'],
                    'buttons' => [
                      'confirm' => function ($url) {
                          return Html::a('<span class="fa fa-check"></span>',Url::to($url));
                      },
                    ]
                ],
                ],
         ]); ?>

          <?= Html::endForm();?>
        <?php Pjax::end(); ?>
    </div>

</div>

<?php

$this->registerJsFile('@web/js/pedido.js', ['depends' => [yii\web\AssetBundle::className()]]);
?>
 