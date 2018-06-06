<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ComandaDetalle */

$this->title = Yii::t('app', 'Create Comanda Detalle');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comanda Detalles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comanda-detalle-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
