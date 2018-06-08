<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Producto */

$this->title = $model->nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Productos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="producto-view">
  <div class="box box-warning with-border">
    <div class="box-header">
      <?= $this->title?>
      <div class="pull-right">
        <?= Html::a('<i class="fa fa-arrow-left"></i> Volver',Yii::$app->request->referrer, ['class'=>'btn btn-primary']) ?>
        <?php if (!empty($model->web_id)) {
          echo Html::a(Yii::t('app', 'Quitar de Venta'), ['quitar-producto', 'id' => $model->id], ['class' => 'btn btn-primary']);
        } ?>
        <?php if (!empty($model->web_id)) {
	        echo Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
        } ?>

      </div>
    </div>
    <div class="box-body">
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'codigo',
              'nombre',
              [
                'label' => 'Categoria',
                'attribute' => 'categoria.nombre'
              ],
              [
                'label' => 'Precio Unitario',
                'attribute' => 'precio_unitario',
                'format' => ['currency'],
              ],
          ],
      ]) ?>
    </div>
  </div>
</div>
