<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use jino5577\daterangepicker\DateRangePicker;
use yii\helpers\Url;
use kartik\spinner\Spinner;
use eleiva\noty\Noty;
use app\models\Pedido;
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
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'showFooter' => true,
                'footerRowOptions'=>  ['style' => 'text-align: right; font-weight:bold;'],
                'rowOptions'=> function($model){
                        if(is_array($model) && array_key_exists("aceptado",$model) && !$model["aceptado"]){
                            return ['class' => 'danger'];
                        }else{
                            return ['class' => 'success'];
                        }
                },
                'columns' => [
                    [
                        'label' => 'Nro. Pedido',
                        'attribute' => 'id',
                        'headerOptions' => ['style' => 'width:1%'],
                        'contentOptions' => ['style'=>'text-align:right'],
                    ],
                    [
                        'label' => 'Fecha Hora',
                        'attribute' => 'fecha_hora',
                        'headerOptions' => ['style' => 'width:15%'],
                        'contentOptions' => ['style' => 'width:15%;'],
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
                        'format' => 'raw',
                        'value' => function($model){
                            return $model["username"];
                        },
                        'headerOptions' => ['style' => 'width:10%'],
                        'contentOptions' => ['style' => 'width:10px;'],
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {update} {delete} {confirm} {print} ',
                        'headerOptions' => ['style' => 'width:13%'],
                        'contentOptions' => ['style' => 'width:13px;'],
                        'buttons' => [
                            'confirm' => function ($url, $model) {
                                $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                                if ( current($userRole)->name !='Viajante' && $model["estado_id"]!=1)
                                    {
                                        $url =  Url::toRoute(['pedido/update', 'id' => $model["id"], 'proceso' => 'aceptar']);
                                        return Html::a('<span class="fa fa-check"></span>',Url::to($url));
                                    }
                                if ( current($userRole)->name =='Gerente' && $model["estado_id"]==1)
                                    {
                                        $url =  Url::toRoute(['pedido/update', 'id' => $model["id"], 'proceso' => 'aceptar']);
                                        return Html::a('<span class="fa fa-check"></span>',Url::to($url));
                                    }
                                else      
                                    return "";
                            },
                            'print' => function ($url,$model) {
                                $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                                if ( current($userRole)->name !='Viajante' && $model["estado_id"]!=1)
                                    return Html::a(Html::encode('IMPRIMIR'), Url::to($url), [
                                        'class' => 'label label-warning rounded','target'=>'_blank'
                                    ]);
                            },
                            'update' => function ($url, $model) {
                                $userRole = Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId());
                                if ( current($userRole)->name !='Viajante')
                                {
                                    $url =  Url::toRoute(['pedido/update', 'id' => $model["id"]]);
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',Url::to($url));
                                }
                                if ( current($userRole)->name == 'Viajante' && $model["estado_id"]==1)
                                {
                                    $url =  Url::toRoute(['pedido/update', 'id' => $model["id"]]);
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>',Url::to($url));
                                }
            
                                else
                                    return "";
                            },
                         'delete' => function ($url, $model) {                 
                             return Html::a('<span style="margin-left:5px;" class="glyphicon glyphicon-trash"></span>', '#', [
                              'title' => Yii::t('app', 'Delete'),
                              'class'=> '',
                              'onclick' => "
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
     
                         },
                        ]

                    ],
                ],
            ]); ?>
        <?= Html::endForm();?>
    </div>

</div>

<?php

$this->registerJsFile('@web/js/pedido.js', ['depends' => [yii\web\AssetBundle::className()]]);
?>
 