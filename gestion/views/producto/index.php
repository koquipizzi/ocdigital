<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use xj\bootbox\BootboxAsset;
use kartik\spinner\Spinner;
use eleiva\noty\Noty;
BootboxAsset::register($this);
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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

$this->title = Yii::t('app', 'Productos');
$this->params['breadcrumbs'][] = $this->title;
?>
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
<div class="producto-index">
  <div class="box box-warning with-border">
    <div class="box-header">
      <?= Html::encode(Yii::t('app', 'Listado de Productos')) ?>
      <div class="pull-right">
        <?= Html::a(Yii::t('app', 'Create Producto'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php
          $url = Url::toRoute('producto/sync');
          echo Html::a('Sincronizar Productos', '#', [
            'class' => 'btn btn-success nspinner',
            'title' => Yii::t('yii', 'Close'),
                'onclick'=>'
                $.ajax("'.$url.'",  {data: {id: 1},
                  type: "POST",
              }).done(function(data) {
                $(".wspinner").hide();
                $(".nspinner").show();
                var n = noty({
                  text: data.message,
                  type: data.rta,
                  class: "animated pulse",
                  layout      : "topRight",
                  theme       : "relax",
                  timeout: 2000, // delay for closing event. Set false for sticky notifications
                  force: false, // adds notification to the beginning of queue when set to true
                  modal: false, // si pongo true me hace el efecto de pantalla gris
           //       maxVisible  : 10
              });
                $.pjax.reload({container:"#Productos"});
              });
                ',                         ]);
       ?>
        <?php
          echo '<button style="display:none" class="btn btn-success wspinner"';
          echo Spinner::widget(['preset' => 'tiny', 'align' => 'left', 'caption' => 'Sincronizando &hellip;']);
          echo '</button>';
        ?>

      </div>

    <div class="box-body">
    <?php Pjax::begin(['id' => 'Productos']); ?>
         <?= GridView::widget([
          'id' => 'Productos',
          'dataProvider' => $dataProvider,
          'filterModel' => $searchModel,
          'columns' => [
              ['class' => 'yii\grid\SerialColumn'],
              'codigo',
              'nombre',
              [
                'label' => 'Categoría',
                'attribute' => 'categoria_id',
                'value' => 'categoria.nombre',
              ],
              [
              'label' => 'Precio Unitario',
              'attribute' => 'precio_unitario',
              'format' => ['currency'],
              'contentOptions' => ['class' => 'text-right'],
              'headerOptions' => ['class' => 'text-right']
              ],
              ['class' => 'yii\grid\ActionColumn',
              'template' => '{view} {update}']
          ],
      ]); ?>
      <?php Pjax::end(); ?>
    </div>
  </div>
</div>
