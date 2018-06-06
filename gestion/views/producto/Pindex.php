<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use jino5577\daterangepicker\DateRangePicker;
use yii\helpers\Url;
use kartik\spinner\Spinner;
use eleiva\noty\Noty;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PedidoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Productos');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

$script = <<< JS
$(document).ready(function(){
    $('.wspinner').hide()
    $('.nspinner').click(function(){
        $('.nspinner').hide()
        $('.wspinner').show()
    });
});
JS;
$this->registerJs($script);

$pjaxRegister = <<<JS
  $( "input[type=checkbox]" ).on("click",function(){
    id = $(this).val();
    if ($(this).is(':checked')) {
      $('#seleccion').val(id);
    }else{
      $('#unselected').val(id);
    }
  })
// $(document).on('pjax:complete', function() {
  //
// });
JS;



if(!empty($info))
{
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
  }

} ?>

<div class="pedido-index">
  <div class="box box-warning with-border">
    <div class="box-header">
     <?= Html::encode(Yii::t('app', 'Listado de Productos Pendientes')) ?>
      <?= Html::tag('span', '<i class="fa fa-info-circle"></i>', [
                            'title'=>'Listado de productos no disponibles para la venta',
                            'data-toggle'=>'tooltip',
                            'data-placement'=>'right',
                            'style'=>'text-decoration: none; cursor:pointer;'
                        ]); ?>
      <div class="pull-right">
        <?= Html::beginForm(['setrol'],'post');?>
        <?php
        $url = Url::toRoute('setrol');
        echo Html::submitButton('Habilitar Productos', ['class' => 'btn btn-success',
            'title' => Yii::t('yii', 'Close'),
                'onclick'=>'$.ajax("'.$url.'",{
                  data: {id: 1},
                  type: "POST",
              }).done(function(data) {
                $(".wspinner").hide();
                $(".nspinner").show();
              });
                $.pjax.reload({container:"#Pedidos"});']);
        ?>
        <?php
          echo '<button style="display:none;" class="btn btn-success wspinner"';
          echo Spinner::widget(['preset' => 'tiny', 'align' => 'left', 'caption' => 'Procesando &hellip;']);
          echo '</button>';
        ?>
        <div id="seleccion"></div>
        <div id="unselected"></div>
        <?php Pjax::begin(['id'=> 'pedidos']);
        $this->registerJs($pjaxRegister, \yii\web\View::POS_END);
        ?>
    </div>
    <div class="box-body">
         <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                      ['class' => 'yii\grid\CheckboxColumn',
                                  'checkboxOptions' => function($model, $key, $index, $widget) {
                                                                  return ['value' => $model->id ];
                                                                }
                      ],
                      'nombre',
                      [
                        'label' => 'Categoría',
                        'attribute' => 'nombre',
                        'value' => 'categoria.nombre'
                      ],
                      [
                      'label' => 'Precio Unitario',
                      'attribute' => 'precio_unitario',
                      'format' => ['currency'],
                      'contentOptions' => ['class' => 'text-right'],
                      'headerOptions' => ['class' => 'text-right']
                      ],
                      ['class' => 'yii\grid\ActionColumn',
                      'template' => '{view}',],
                ],
      ]); ?>
        <?= Html::endForm();?>
      <?php  Pjax::end(); ?>
    </div>
  </div>
</div>
