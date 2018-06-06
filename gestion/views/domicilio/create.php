<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Domicilio */

$this->title = Yii::t('app', 'Create Domicilio');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Domicilios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="domicilio-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
