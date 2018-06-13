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
    
    <div class="box box-warning with-border">
    <div class="box-header">
      <?= Html::encode(Yii::t('app', 'Listado de Pedidos')) ?>
        <div class="pull-right">
            <?= Html::a(Yii::t('app', 'Nuevo Pedido'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    <div class="box-body">
        <?php
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showFooter' => true,
                'footerRowOptions'=>  ['style' => 'text-align: right; font-weight:bold;'],
                'rowOptions'=> function($model){
                        if(is_array($model) && array_key_exists("aceptado",$model) && !$model["aceptado"]){
                            return ['class' => 'danger'];
                        }else{
                            return ['class' => 'success'];
                        }
                },
                'columns' => [
                    [
                        'label' => 'Nro. Pedido',
                        'attribute' => 'id',
                        'headerOptions' => ['style' => 'width:1%']
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
                        'label' => 'Fecha de Ingreso',
                        'attribute' => 'fecha_hora',
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
                        'label' => 'Razón Social / Nombre',
                        'attribute' => 'razon_social',
                        'headerOptions' => ['style' => 'width:20%'],
                        'contentOptions' => ['style' => 'width:20px;'],
                    ],
                    [
                        'label' => 'Gestor Del Pedido',
                        'format' => 'raw',
                        'value' => function($model){
                            return $model["username"];
                        },
                        'headerOptions' => ['style' => 'width:10%'],
                        'contentOptions' => ['style' => 'width:10px;'],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {confirm} {print} ',
                        'headerOptions' => ['style' => 'width:13%'],
                        'contentOptions' => ['style' => 'width:13px;'],
                        'buttons' => [
                            'confirm' => function ($url, $model) {
                                $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                                if ( current($userRole)->name !='Viajante' && $model["estado_id"]!=1)
                                    {
                                        $url =  Url::toRoute(['pedido/update', 'id' => $model["id"], 'proceso' => 'aceptar']);
                                        return Html::a('<span class="fa fa-check"></span>',Url::to($url));
                                    }
                                if ( current($userRole)->name =='Gerente' && $model["estado_id"]==1)
                                    {
                                        $url =  Url::toRoute(['pedido/update', 'id' => $model["id"], 'proceso' => 'aceptar']);
                                        return Html::a('<span class="fa fa-check"></span>',Url::to($url));
                                    }
                                else      
                                    return "";
                            },
                            'print' => function ($url,$model) {
                                $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                                if ( current($userRole)->name !='Viajante' && $model["estado_id"]!=1)
                                    return Html::a('<span class="fa fa-print"></span>',Url::to($url),['target'=>'_blank']);
                            },
                            'update' => function ($url, $model) {
                                $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                                if ( current($userRole)->name !='Viajante')
                                {
                                    $url =  Url::toRoute(['pedido/update', 'id' => $model["id"]]);
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',Url::to($url));
                                }
                                if ( current($userRole)->name == 'Viajante' && $model["estado_id"]==1)
                                {
                                    $url =  Url::toRoute(['pedido/update', 'id' => $model["id"]]);
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',Url::to($url));
                                }
            
                                else
                                    return "";
                            },
                            'delete' => function ($url, $model) {
                                $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                                if ( current($userRole)->name !='Viajante')
                                {
                                    $url =  Url::toRoute(['pedido/delete', 'id' => $model["id"]]);
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>',Url::to($url));
                                }
                                if ( current($userRole)->name ==='Viajante' && $model["estado_id"]==1)
                                {
                                    $url =  Url::toRoute(['pedido/delete', 'id' => $model["id"]]);
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>',Url::to($url));
                                }
                                else
                                    return "";
                            },
                        ]

                    ],
                ],
            ]); ?>
        <?= Html::endForm();?>
        
    </div>

</div>

<?php

$this->registerJsFile('@web/js/pedido.js', ['depends' => [yii\web\AssetBundle::className()]]);
?>
 