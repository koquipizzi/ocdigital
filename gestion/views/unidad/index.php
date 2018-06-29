<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UnidadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Unidads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="unidad-index">
    <div class="box box-warning with-border">
        <div class="box-header">
            <?= Html::encode(Yii::t('app', 'Listado de Unidades')) ?>
            <div class="pull-right">
                <?= Html::a(Yii::t('app', 'Create Unidad'), ['create'], ['class' => 'btn btn-success']) ?>
            </div>
        </div>
        <div class="box-body">

            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    'nombre_unidad',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
