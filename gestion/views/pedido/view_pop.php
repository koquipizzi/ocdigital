<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <?php /* DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'allDay',
            'start',
            'end',
            'url:url',
            'className',
            'editable',
            'startEditable',
            'durationEditable',
     //       'source',
     //       'color',
     //       'backgroundColor',
      //      'borderColor',
       //     'textColor',
        ],
    ])*/ ?>

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
                    ]) 
                    
        ?>
            </div>
        <div class="box box-warning with-border">
                <div class="box-header">
                    <h3 class="box-title">Productos Pedidos:</h3>
                </div>
                <div class="box-body table-responsive">
                 
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
