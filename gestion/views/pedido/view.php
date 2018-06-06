<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use eleiva\noty\Noty;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = 'Pedido Nro: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pedido-view">
  <div class="box box-warning with-border">
    <div class="box-header">
      <?= Html::encode($this->title) ?>
      <div class="pull-right">
        <?= Html::a('<i class="fa fa-arrow-left"></i> Volver',Yii::$app->request->referrer, ['class'=>'btn btn-primary']) ?>
        <?php
        if (empty($model['comanda_id'])) {
          echo Html::a(Yii::t('app', 'Confirmar Pedido'), ['confirm', 'id' => $model->id], ['class' => 'btn btn-primary']);  
        }
        if (empty($model['comanda_id']))
        {

        }
        ?>
        <?php
        if (empty($model['comanda_id']))
        {
          echo  Html::a(Yii::t('app', 'Agregar a Comanda'), ['comanda/asignar-comanda', 'id' => $model->id],
          [
              'class' => 'btn btn-danger',
              'data' => [
                  'confirm' => Yii::t('app', 'Esta seguro que desea asignar pedido a la ultima comanda activa?'),
                  'method' => 'post',
                ]
          ]);
        }
        ?>
        <?php
        if (empty($model['comanda_id']))
        {
          echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        }else{

        } ?>
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
            'label' => 'Total',
            'attribute' => 'precio_total',
            'format' => ['currency'],
            ],
        ],
    ]) ?>
  </div>
  <div class="box-body">
    <?= GridView::widget(['dataProvider' => $dataProvider,  'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
        ['attribute' => 'Producto','value' => 'producto.nombre'],
        ['label' => 'Categoría','value' => 'producto.categoria.nombre'],
        [
          'label' => 'Cantidad',
          'attribute' => 'cantidad',
          'contentOptions' => ['class' => 'text-right'],
          'headerOptions' => ['class' => 'text-right']
        ],
        [
          'label' => 'Subtotal',
          'attribute' => 'precio_linea',
          'format' => ['currency'],
          'contentOptions' => ['class' => 'text-right'],
          'headerOptions' => ['class' => 'text-right']
        ],
      ] ]);?>
  </div>

</div>
