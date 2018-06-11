<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Unidad */

$this->title = Yii::t('app', 'Update Unidad: {nameAttribute}', [
    'nameAttribute' => $model->nombre_unidad,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unidads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre_unidad, 'url' => ['view', 'id' => $model->nombre_unidad]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>


<div class="unidad-update">
  <div class="box box-warning with-border">
    <div class="box-body">
      <?= $this->render('_form', [
          'model' => $model,
      ]) ?>
    </div>
  </div>
</div>
