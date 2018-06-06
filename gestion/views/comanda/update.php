<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Pedido;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Comanda */

$this->title = Yii::t('app', 'Detalle de Comanda '). $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comandas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Detalle');
?>
<div class="comanda-update">
<?php
if(!empty($info))
{
    echo  "<div class='alert alert-success alert-dismissible'>
                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
                <h4><i class='icon fa fa-check'></i></h4> $info
              </div>
          ";
} ?>
  <div class="box box-info">
    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
    </div>
  </div>

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
                              ],
                              [
                                'label' => 'Fecha Hora',
                                'attribute' => 'fecha_hora',
                                'format' => ['date', 'php:d/m/Y  H:i'],
                              ],
                              [
                                  'label' => 'Razón Social',
                                  'attribute' => 'razon_social',
                                  'value' => 'cliente.razon_social'
                              ],
                              [
                              'label' => 'Precio Total',
                              'attribute' => 'precio_total',
                              'format' => ['currency'],
                              'contentOptions' => ['class' => 'text-right'],
                              'headerOptions' => ['class' => 'text-right']
                              ],
                            ]]);?>
        </div>
      </div>
    </div>
  </div>
</div>
