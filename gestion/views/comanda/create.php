<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Comanda */

$this->title = Yii::t('app', 'Create Comanda');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Comandas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="comanda-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
