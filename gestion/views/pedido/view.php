<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use eleiva\noty\Noty;
use app\models\Unidad;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */
-
$mensaje = Yii::$app->getRequest()->getQueryParam('mensaje'); 
$error = Yii::$app->getRequest()->getQueryParam('error'); 


if(!empty($mensaje))
{
  if ($mensaje){
    echo Noty::widget([
      'text' => $mensaje,
      'type' => Noty::ERROR,
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
      'text' => $mensaje,
      'type' => Noty::SUCCESS,
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

} 

$this->title = 'Pedido Nro: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index_pendientes']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-view">
  <div class="box box-warning with-border">
    <div class="box-header">
      <?= Html::encode($this->title) ?>
      <div class="pull-right">
        <?= Html::a('<i class="fa fa-arrow-left"></i> Volver',Yii::$app->request->referrer, ['class'=>'btn btn-primary']) ?>
          <?php
            $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
            if ( current($userRole)->name !='Viajante')
            {
                echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);;
            }
            if ( current($userRole)->name == 'Viajante' && $model->estado_id==1)
            {
                echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);;
            }
            
           ?>
    </div>
  </div>
  <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Razon Social / Nombre',
                'value' => $model->getClienteRazonSocial(),
            ],
            [
                'label' => 'Fecha del Pedido',
                'attribute' => 'fecha_hora',
                'format' => ['date', 'php:d/m/Y  H:i'],
            ],
            [
                'label' => 'Fecha de Entrega',
                'attribute' => 'fecha_entrega',
                'format' => ['date', 'php:d/m/Y '],
            ],
            [
                'label' => 'Estado',
                'value' => function($model){
                    return $model->EstadoNombre;
                }
            ],
            [
                'label' => 'Gestor',
                'value' => function($model){
                    return $model->getGestorPedidoName();
                },
            ]
        ],
    ]) ?>
  </div>
  <div class="box-body">
    <?= GridView::widget(['dataProvider' => $dataProvider,  'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        [   'attribute' => 'Producto',
            'value' => 'producto.nombre',
            'headerOptions' => ['style' => 'width:54%'],
        ],
//        ['label' => 'Categoría','value' => 'producto.categoria.nombre'],
        [
          'label' => 'Cantidad',
          'attribute' => 'cantidad',
          'contentOptions' => ['class' => 'text-right'],
          'headerOptions' => ['class' => 'text-right'],
          'headerOptions' => ['style' => 'width:23px;'],
        ],
        ['label' => 'Unidad', 'value' => 'unidad.nombre_unidad'],
        [
          'label' => 'Precio Unitario',
          'attribute' => 'precio_unitario',
          'format' => ['currency'],
          'contentOptions' => ['class' => 'text-right'],
          'headerOptions' => ['class' => 'text-right']
        ],
      ] ]);?>
  </div>

</div>
