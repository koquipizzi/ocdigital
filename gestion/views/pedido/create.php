<?php

use yii\helpers\Html;
use eleiva\noty\Noty;


/* @var $this yii\web\View */
/* @var $model app\models\Pedido */

$this->title = Yii::t('app', 'Crear Pedido Manual');

$this->params['breadcrumbs'][] = $this->title;
?>

<?php
if(!empty($error))
{
    echo  Noty::widget([
      'text' => $error,
      'type' => Noty::ERROR,
      'useAnimateCss' => true,
      'clientOptions' => [
          'timeout' => 3000,
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
} ?>

<div class="pedido-create">
  <div class="box box-warning with-border">
        <div class="box-body table-responsive">
      <?php 
        echo $this->render('_form', [
          'model' => $model,
          'modelsPedidoDetalle' => (empty($modelsPedidoDetalle)) ? [new PedidoDetalle] : $modelsPedidoDetalle
          ]); 
      ?>
    </div>
  </div>
</div>
