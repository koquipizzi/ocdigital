<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Unidad */

$this->title = Yii::t('app', 'Create Unidad');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Unidads'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-create">
  <div class="box box-warning with-border">
    <div class="box-body">
      <?= $this->render('_form', [
          'model' => $model,
      ]) ?>
    </div>
  </div>
</div>