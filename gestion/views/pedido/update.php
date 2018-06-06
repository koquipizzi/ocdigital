<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Pedido',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Pedidos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="pedido-update">
  <div class="box box-warning with-border">
    <div class="box-body">
      <?= $this->render('_form', [
          'model' => $model,'modelsPedidoDetalle' => (empty($modelsPedidoDetalle)) ? [new PedidoDetalle] : $modelsPedidoDetalle
          ]); ?>
    </div>
  </div>
</div>
