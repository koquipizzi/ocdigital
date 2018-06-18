<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Producto;
use app\models\ClienteSearch;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = $model->razon_social;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-view">

  <div class="box box-warning with-border">
    <div class="box-header">
      <?= Html::encode($this->title) ?>
      <div class="pull-right">
        <?= Html::a('<i class="fa fa-arrow-left"></i> Volver', ['cliente/index'], ['class'=>'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
      </div>
    </div>

  <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'codigo',
            'nombre',
            'apellido',
            'razon_social',
            'email',
            'direccion',
            'telefono',
            'hora_reparto',
            'vendedor'
        ],
    ]) ?>
    <hr>
    <div class="panel panel-default">
        <div class="panel-heading">
            <i class="fa fa-list-ul"></i> Listado Productos Especiales
            <div class="clearfix"></div>
        </div>
        <div class="panel-body container-items"><!-- widgetContainer -->
            <?= GridView::widget(['dataProvider' =>  !empty($dataProvider) ? $dataProvider :  ClienteSearch::searchProductos($model),
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                      'attribute' => 'Producto',
                      'value' => 'nombre',
                    ],
                    [
                      'attribute' => 'Precio',
                      'value' => 'precio_unitario',
                      'contentOptions' => ['class' => 'text-right'],
                      'format' => ['currency']
                    ],
                    [
                      'label' => 'Accion',
                      'attribute' => 'id',
                      'contentOptions' => ['style' => 'width:8%'],
                      'format' => 'raw',
                      'value'=>function ($data) {
                          return Html::a('<span class="fa fa-eye"></span>',Url::to(["producto/view/", 'id' => $data['id']]));
                      },
                    ]
                  ]
                ]);?>
        </div>
      </div>
  </div>
</div>
