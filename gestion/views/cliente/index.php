<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use eleiva\noty\Noty;
use kartik\editable\Editable;
use kartik\spinner\Spinner;
use xj\bootbox\BootboxAsset;
BootboxAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel app\models\ClienteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Clientes');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php
if(!empty($error))
{
  if ($error['error']){
    echo Noty::widget([
      'text' => $error['mensaje'],
      'type' => Noty::ERROR,
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
      'text' => $error['mensaje'],
      'type' => Noty::SUCCESS,
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

<div class="cliente-index">
  <div class="box box-warning with-border">
    <div class="box-header">
      <?= Html::encode(Yii::t('app', 'Listado de Clientes')) ?>
      <div class="pull-right">
          <?= Html::a(Yii::t('app', 'Create Cliente'), ['create'], ['class' => 'btn btn-success']) ?>
      </div>
    </div>
  <div class="box-body">
    <?php Pjax::begin(['id' => 'clientes']); ?>    <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'nombre',
                'apellido',
                'razon_social',
                'usuario_web',
                [
                            'label' => 'E-mail',
                            'attribute' => 'email',
                            'filter' => true,
                            'format' => 'raw',
                            'value' => function ($model, $data) {
                                $form = '<form id="kv-login-form" class="form-vertical" action="/index.php?r=cliente/edit-email">
                                <input type="hidden" name="_csrf" value="jUza6moXT7HDpHpr5H_Y56k_y_IdH0BNh_HshXsWA6f4JoPSLlAV5I_XLCWIKY-uxHCCtXxpOBv-mq-1JE9Z_Q==">
                                <div class="form-group field-mail-mails">';
                                    $editable = Editable::widget([
                                        'name'=>'email',
                                        'asPopover' => false,
                                        'format' => Editable::FORMAT_BUTTON,
                                        'value'=>$model->email,
                                        'formOptions' => [
                                            'method' => 'post',
                                            'action' => ['cliente/edit-email'] ],
                                        'pluginEvents' => [
                                            'editableSuccess'=>"function(event, val, form, data) { $.pjax.reload({container: '#clientes'}); }",
                                        ],
                                        'header' => FALSE,
                                        'size'=>'xs',
                                        'options' => ['class'=>'form-control', 'placeholder'=>'E-Mail...'],
                                        'afterInput'=>
                                         //       Html::hiddenInput('key',$key).
                                                Html::hiddenInput('id',$model->id),
                                    ]);
                                    return $editable;
                            },
                          ],


                ['class' => 'yii\grid\ActionColumn',
                'headerOptions' => ['style' => 'width:7%'],
                'template' => '{view} {edit} {createWeb}',
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
                                  'createWeb' => function ($url, $model) {
                                     return Html::a('<span class="fa fa-refresh"></span>', $url, [
                                                 'title' => Yii::t('app', 'Sincronizar con la Web'),
                                                 'value' => "$url",
                                   ]);
                                 }
                              ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'view') {
                        $url ='index.php?r=cliente/view&id='.$model->id;
                        return $url;
                        }
                    if ($action === 'edit') {
                        $url ='index.php?r=cliente/update&id='.$model->id;
                        return $url;
                        }
                    if ($action === 'delete') {
                        $url ='index.php?r=cliente/delete&id='.$model->id;
                        return $url;
                        }
                    if ($action === 'createWeb') {
                        $url ='index.php?r=cliente/create-web&id='.$model->id;
                        return $url;
                        }
                    }
                ]
            ]
            ]);
         ?>
    <?php Pjax::end(); ?>
  </div>
</div>
</div>
