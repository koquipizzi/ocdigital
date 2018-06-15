<?php

use yii\helpers\Html;
    use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use jino5577\daterangepicker\DateRangePicker;
use app\models\Pedido;
    use eleiva\noty\Noty;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pedidos Históricos');
$this->params['breadcrumbs'][] = $this->title;

if(!empty($info))
{
if (!$info['error']){
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
  <div class="box box-warning with-border">
    <div class="box-header">
      <?= Html::encode(Yii::t('app', 'Listado de Pedidos')) ?>
    </div>
    <div class="box-body">
      <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showFooter' => true,
                'footerRowOptions'=>  ['style' => 'text-align: right; font-weight:bold;'],
                'columns' => [
                  [
                    'label' => 'Pedido Nro',
                    'attribute' => 'id',
                    'headerOptions' => ['style' => 'width:10%']
                  ],
                  [
                    'label' => 'Fecha Hora',
                    'attribute' => 'fecha_hora',
                    'contentOptions' => ['style' => 'width:20%;'],
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
                        'attribute' => 'fecha_hora',
                        'pluginOptions' => [
                            'locale'=>[
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
                  [   'class' => 'yii\grid\ActionColumn',
                      'template' => '{view} {print}',
                      'headerOptions' => ['style' => 'width:13%'],
                      'contentOptions' => ['style' => 'width:13px;'],
                      'buttons' => [
                          'print' => function ($url,$data) {
                                return Html::a('<span class="fa fa-print"></span>',Url::to($url),['target'=>'_blank']);
                          },
                      ]
                  ],
                ]
            ]); ?>

    </div>
  </div>
</div>  
