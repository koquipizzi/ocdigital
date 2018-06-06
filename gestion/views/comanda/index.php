<?php

use yii\helpers\Html;
use yii\grid\GridView;

use jino5577\daterangepicker\DateRangePicker;
use yii\widgets\ActiveForm;
use eleiva\noty\Noty;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ComandaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Listado de Comandas');
$this->params['breadcrumbs'][] = $this->title;

$js = <<< 'SCRIPT'
/* To initialize BS3 tooltips set this below */
$(function () {
    $("[data-toggle='tooltip']").tooltip();
});;
/* To initialize BS3 popovers set this below */
$(function () {
    $("[data-toggle='popover']").popover();
});
SCRIPT;
// Register tooltip/popover initialization javascript
$this->registerJs($js);

?>
<div class="comanda-index">

  <?php
  if(!empty($info)){
    if (!$info['error']){
      echo Noty::widget([
        'text' => $info['mensaje'],
        'type' => Noty::SUCCESS,
        'useAnimateCss' => true,
        'clientOptions' => [
            'timeout' => 5000,
            'layout' => 'topCenter',
            'dismissQueue' => true,
            'progressBar'=> true,
            'killer' => true,
            'theme' => 'metroui',
            'animation' => [
                'open' => 'animated bounceInLeft',
                'close' => 'animated bounceOutLeft',
                'easing' => 'swing',
                'speed' => 500
            ]
        ]
    ]);
    }else{
      echo Noty::widget([
        'text' => $info['mensaje'],
        'type' => Noty::ERROR,
        'useAnimateCss' => true,
        'clientOptions' => [
            'timeout' => 2000,
            'layout' => 'topCenter',
            'dismissQueue' => true,
            'theme' => 'metroui',
            'progressBar'=> true,
            'killer' => true,
            'animation' => [
                'open' => 'animated bounceInLeft',
                'close' => 'animated bounceOutLeft',
                'easing' => 'swing',
                'speed' => 500
            ]
        ]
    ]);
  }} ?>
  <div class="box box-warning with-border">
    <!-- <div class="box-header"> -->
       <!-- <div class="pull-right"> -->
        <!--?= Html::a(Yii::t('app', 'Create Comanda'), ['create'], ['class' => 'btn btn-success']) ?-->
      <!-- </div> -->
    <!-- </div> -->
    <div class="box-body">
      <?php ?>    <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'filterModel' => $searchModel,
              'columns' => [
                [
                  'label' => 'Nro. Comanda',
                  'attribute' => 'id',
                  'headerOptions' => ['style' => 'width:10%']
                ],
                [
                  'attribute' => 'fecha_produccion',
                  'headerOptions' => ['style' => 'width:30%'],
                  'contentOptions' => ['style' => 'width:20%;'],
                  'format' => ['date', 'php:d/m/Y'],
                  'filter' => DateRangePicker::widget([
                  'template' => '
                          <div class="input-group">
                              <span class="input-group-addon">
                                  <span class="glyphicon glyphicon-calendar"></span>
                              </span>
                              {input}
                          </div>
                      ',
                       'model' => $searchModel,
                       'locale'    => 'es-ES',
                      'attribute' => 'fecha_produccion',
                      'pluginOptions' => [
                          'locale'=>[
                              'format'=>'DD/MM/YYYY',
                              'separator'=>' - ',
                              'applyLabel' => 'Seleccionar',
                              'cancelLabel' => 'Cancelar',
                          ],
                          'autoUpdateInput' => false,
                      ]
                   ])
                ],
                [
                    'label' => 'Nota','format' => 'raw',
                    'value' => function ($model) {
                   //     Html::decode(Html::decode($model->replace));
                        return   Html::tag('span', $model->notaTexto, [
                            'title'=>$model->nota,
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'right',
                            'style'=>'text-decoration: underline; cursor:pointer;'
                        ]);
                    }
                  //  'attribute' => 'notaTexto'
                ],
               //   'nota',
                  ['class' => 'yii\grid\ActionColumn',
                  'template' => '{view} {edit} {imprimir} {imprimircat} {logistica}',
                  'contentOptions' => ['style' => 'width:20%'],
                  'buttons' => [
                                  'view' => function ($url, $model) {
                                      return Html::a('<span class="fa fa-eye "></span>', $url, [
                                                  'title' => Yii::t('app', 'View'),
                                                  'value'=> "$url",
                                      ]);
                                  },
                                   'edit' => function ($url, $model) {
                                      return Html::a('<span class="fa fa-pencil"></span>', $url, [
                                                  'title' => Yii::t('app', 'Editar'),
                                                  'value'=> "$url",
                                      ]);
                                  },
                                  'imprimir' => function ($url, $model) {
                                     return Html::a('<span class="fa fa-users"></span>', $url, [
                                                 'title' => Yii::t('app', 'Imprimir comandas por clientes'),
                                                 'value' => "$url",
                                   ]);
                                 },
                                    'logistica' => function ($url, $model) {
                                        return Html::a('<span class="fa fa-truck"></span>', $url, [
                                                    'title' => Yii::t('app', 'Logística'),
                                                    'value' => "$url",
                                    ]);
                                    },
                                    'imprimircat' => function ($url, $model) {
                                        return Html::a('<span class="fa fa-cutlery"></span>', $url, [
                                                    'title' => Yii::t('app', 'Imprimir comandas por cocinas'),
                                                    'value' => "$url",
                                    ]);
                                }
                              ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url ='index.php?r=comanda/view&id='.$model->id;
                        return $url;
                        }
                    if ($action === 'edit') {
                        $url ='index.php?r=comanda/update&id='.$model->id;
                        return $url;
                        }
                    if ($action === 'logistica') {
                        $url ='index.php?r=comanda/view-pedidos&id='.$model->id;
                        return $url;
                        }
                    if ($action === 'imprimir') {
                        $url ='index.php?r=comanda/imprimir-comandas&id='.$model->id;
                        return $url;
                        }
                    if ($action === 'imprimircat') {
                        $url ='index.php?r=comanda/imprimircat-comandas&id='.$model->id;
                        return $url;
                        }
                    }
                ]
              ],
          ]); ?>
      <?php  ?>
    </div>
  </div>
</div>
