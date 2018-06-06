<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Cliente */

$this->title = Yii::t('app', 'Create Cliente');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Clientes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cliente-create">
<div class="box box-warning">
  <div class="box-header">
    <?= Html::encode($this->title) ?>
  </div>
  <div class="box-body">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
  </div>
</div>



</div>
