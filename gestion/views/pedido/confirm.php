<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', "Confirmación del Pedido Número: $model->id");
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pedidos-confirmacion">
  <div class="box box-warning with-border">
    <?= $this->render('_form_confirm', [
        'model' => $model,
        ]); ?>
</div>
