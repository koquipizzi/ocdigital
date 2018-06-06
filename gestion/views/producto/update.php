<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = Yii::t('app', 'Update ' ) . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="producto-update">
  <div class="box box-warning with-border">
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    </div>
  </div>
</div>
