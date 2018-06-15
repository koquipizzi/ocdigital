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
    <div class="row">
        <div class="col-md-12">
            <div class="pull-right">
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
       
    </div>
    <br>
    <div class="row">
        <div class="col-md-4">
            <div class="box box-warning with-border">
                <div class="box-body">
                    <h4>Detalles Pedido:</h4>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'label' => 'Razón Social',
                                'value' => $model->getClienteRazonSocial(),
                            ],
                            [
                                'label' => 'Fecha',
                                'attribute' => 'fecha_hora',
                                'format' => ['date', 'php:d/m/Y'],
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
            </div>
        </div>
        <div class="col-md-8">
            <div class="box box-warning with-border">
                <div class="box-body table-responsive">
                    <h4>Productos Pedidos:</h4>
                    <?= GridView::widget(['dataProvider' => $dataProvider,
                        'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        [   'attribute' => 'Producto',
                            'value' => 'producto.nombre',
                            'headerOptions' => ['style' => 'width:54%'],
                        ],
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
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="box box-warning with-border">
                <div class="box-body table-responsive">
                    <h4>Historial de Cambios de Estado del Pedido</h4>
                    <?= GridView::widget([
                        'dataProvider' => $dataProviderWorkflow,
    
                        'tableOptions' => ['class' => 'table table-striped table-bordered table-responsive'],
                        'columns' => [
                            'estado',
                            [
                                'attribute' => 'fecha_inicio',
                                'format' => ['date', 'php:d/m/Y  H:i'],
                            ],
                            [
                                'attribute' => 'fecha_fin',
                                'format' => ['date', 'php:d/m/Y  H:i'],
                            ],
                            'responsable'
                
                        ] ]);?>
                </div>
            </div>
        </div>
    </div>
    
</div>


