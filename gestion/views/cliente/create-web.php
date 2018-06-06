<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = Yii::t('app', 'Sincronizar Cliente: ', [
    'modelClass' => 'Cliente',
]) . $model->razon_social;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->razon_social, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Sincronizar';
?>
<div class="cliente-create">
<div class="box box-warning">
  <div class="box-header">
    <?= Html::encode($this->title) ?>
  </div>
  <div class="box-body">
    <?= $this->render('_form_web', ['model' => $model]) ?>
  </div>
</div>



</div>
