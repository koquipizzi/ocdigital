<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = Yii::t('app', 'Create Producto');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-create">
  <div class="box box-warning with-border">
    <div class="box-body">
      <?= $this->render('_form', [
          'model' => $model,
      ]) ?>
    </div>
  </div>
</div>
