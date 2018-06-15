<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use jino5577\daterangepicker\DateRangePicker;
use yii\helpers\Url;
use kartik\spinner\Spinner;
use eleiva\noty\Noty;
use app\models\Pedido;
use yii\helpers\ArrayHelper;
use app\models\Estado;
use xj\bootbox\BootboxAsset;
BootboxAsset::register($this);
$this->title = Yii::t('app', 'Pedidos');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php

$script = <<< JS
$('.ocultar input:checkbox').remove();
$(document).on('pjax:complete', function(event) {
        $('.ocultar input:checkbox').remove();
});
$(document).ready(function(){
    $('.wspinner').hide();
    $('.nspinner').click(function(){
        $('.nspinner').hide();
        $('.wspinner').show();
    });

});
JS;
$this->registerJs($script);

if(!empty($info))
{
  if ($info['estado']){
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
        <div class="pull-left">
           <h2 class="page-header"><?php echo $titulo; ?></h2>
        </div>
        
        <div class="pull-right">
            <?= Html::a(Yii::t('app', 'Nuevo Pedido'), ['create'], ['class' => 'btn btn-success']) ?>
        </div>
    </div>
    <div class="box-body">
        <?php
            Pjax::begin(["id"=>"pedidos"]);
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showFooter' => true,
                'footerRowOptions'=>  ['style' => 'text-align: right; font-weight:bold;'],
                'rowOptions'=> function($model){
                        if(is_array($model) && array_key_exists("estado_id",$model) && $model["estado_id"]==1){
                            return ['class' => 'danger'];
                        }
                },
                'columns' => [
                    [
                        'label' => 'Nro. Pedido',
                        'attribute' => 'id',
                        'headerOptions' => ['style' => 'width:10%']
                    ],
                    [
                     'label'=>Yii::t('app', 'Estado'),
                     'contentOptions' => ['style' => 'width:10%;'],
                     'attribute'=>'estado_id',
                     'value'=>'estado_descripcion',
                     'filter' => Html::activeDropDownList($searchModel, 'estado_id', ArrayHelper::map(Estado::find()->select('id as estado_id,descripcion')->asArray()->all(), 'estado_id', 'descripcion'),['class'=>'form-control','prompt' => 'Estado...']),
                    ],
                    [
                        'label' => 'Fecha de Ingreso',
                        'attribute' => 'fecha_hora',
                        'contentOptions' => ['style' => 'width:10%;'],
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
                            'attribute' => 'fecha_hora',
                            'pluginOptions' => [
                                'locale'=> [
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
                        'label' => 'Razón Social / Nombre',
                        'attribute' => 'razon_social',
                        'headerOptions' => ['style' => 'width:20%'],
                        'contentOptions' => ['style' => 'width:20px;'],
                    ],
                    [
                      'label' => 'Gestor Del Pedido',
                      'attribute' => 'username',
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {confirm} {print} ',
                        'headerOptions' => ['style' => 'width:13%'],
                        'contentOptions' => ['style' => 'width:13px;'],
                        'buttons' => [
                            'update' => function ($url, $model) {
                                $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                                if ( current($userRole)->name == 'Viajante' && $model["estado_id"]==1 && Yii::$app->user->getId()==$model["gestor_id"])
                                {
                                    $url =  Url::toRoute(['pedido/update', 'id' => $model["id"]]);
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',Url::to($url));
                                }
            
                                else
                                    return "";
                             },
                            'delete' => function ($url, $model) {
                                $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                                if ( current($userRole)->name == 'Viajante' && $model["estado_id"]==1 && Yii::$app->user->getId()==$model["gestor_id"])
                                {
                                     return Html::a('<span style="margin-left:5px;" class="glyphicon glyphicon-trash"></span>', '#', [
                                      'title' => Yii::t('app', 'Delete'),
                                      'class'=> '',
                                      'onclick' =>"
                                            bootbox.dialog({
                                                message: '¿Confirma que desea eliminar el pedido {$model["id"]} ?',
                                                title: 'Sistema OCDIGITAL',
                                                // className: 'modal-info modal-center',
                                                buttons: {
                                                success: {
                                                    label: 'Aceptar',
                                                    className: 'btn-primary',
                                                    callback: function () {
                                                        $.ajax('{$url}', {
                                                                type: 'POST',
                                                                datatype: JSON,
                                                                success: function (response)
                                                                {
                                                                    if(response.rta=='ok'){
                                                                       
                                                                        var n = noty
                                                                            ({
                                                                                text:   'El pedido {$model["id"]} se eliminó.',
                                                                                type:   'success',
                                                                                class:  'animated pulse',
                                                                                layout: 'topCenter',
                                                                                theme:  'relax',
                                                                                timeout: 3000, // delay for closing event. Set false for sticky notifications
                                                                                force:  false, // adds notification to the beginning of queue when set to true
                                                                                modal:  false, // si pongo true me hace el efecto de pantalla gris
                                                                                // maxVisible : 10
                                                                            });
                                                                     $.pjax.reload({container:'#pedidos'});
                                                                    }
                                                                    if(response.rta=='ko'){
                                                                        var n = noty
                                                                            ({
                                                                                text:   'Erro no se pudo eliminar el pedido {$model["id"]}.',
                                                                                type:   'error',
                                                                                class:  'animated pulse',
                                                                                layout: 'topCenter',
                                                                                theme:  'relax',
                                                                                timeout: 3000, // delay for closing event. Set false for sticky notifications
                                                                                force:  false, // adds notification to the beginning of queue when set to true
                                                                                modal:  false, // si pongo true me hace el efecto de pantalla gris
                                                                                // maxVisible : 10
                                                                            });
                    
                                                                    }
                
                                                            },
                                                        });
                                                    }
                                                },
                                                cancel: {
                                                    label: 'Cancelar',
                                                    className: 'btn-danger',
                                                    }
                                                }
                                            });
                                            return false;
                                        "
                                      ]);
                                }
                                else
                                    return "";
                            }
                        ]

                    ],
                ],
            ]); ?>
        <?= Html::endForm();?>
        <?php Pjax::end(); ?>
    </div>

</div>

<?php

$this->registerJsFile('@web/js/pedido.js', ['depends' => [yii\web\AssetBundle::className()]]);
?>
