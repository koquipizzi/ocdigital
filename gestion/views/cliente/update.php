<?php

use yii\helpers\Html;
use app\models\Producto;
use eleiva\noty\Noty;

/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = Yii::t('app', 'Modificar {modelClass}: ', [
    'modelClass' => 'Cliente',
]) .  $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<?php
if(!empty($error))
{
  echo Noty::widget([
    'text' => $error,
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
} ?>

<div class="cliente-update">
  <div class="box box-warning with-border">
    <div class="box-body">
      <?=
        $this->render('_form_update', [
          'model' => $model,
          'modelsProductos'=> $modelsProductos,
      ]) ?>
    </div>
</div>
