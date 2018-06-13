<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Cliente;
use app\models\Producto;
use app\models\Pedido;
use app\models\Comanda;
use app\models\ComandaSearch;
use app\models\Event;
use app\models\PedidoSearch;
use yii\grid\GridView;
use insolita\wgadminlte\LteInfoBox;
use insolita\wgadminlte\LteSmallBox;
use insolita\wgadminlte\LteConst;
use yii\bootstrap\Modal;

$this->title = "Sistema de Gestión de Toma de Pedidos";

$this->registerJs('var ajaxHomeIndex = "' .Url::to(['pedido/cantidad']). '";', \yii\web\View::POS_HEAD);
$js = 'function refresh() {
        $.ajax({
            url: ajaxHomeIndex,
            success: function(data) {
            $("#cant").html(data);
            }
        });
      //  $.pjax.reload({container:"#cant"});
        setTimeout(refresh, 50000); // restart the function every 5 seconds
        }
        refresh();';

 $this->registerJs($js, $this::POS_READY);
?>

<?php
  $events = array();
  $e = Event::find()->asArray()->all();
  //var_dump($e); die;

  ?>

  <div class="row">
    <div class="col-lg-8 col-xs-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Pedidos Realizados</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
      
          <?php
              echo \yii2fullcalendarscheduler\yii2fullcalendarscheduler::widget([
              'events'=> $e,
              'id' => 'calendar',
                  'options' => [
                      'eventLimit' => 3,
                      'eventClick'=> 'js:function(calEvent, jsEvent, view) {
                          $("#myModalHeader").html(calEvent.title);
                          $("#myModalBody").load("latihan/training/view/id/"+calEvent.id+"?asModal=true");
                          $("#myModal").modal();
                      }',
                  ],
              ]);
          ?>
          </div>
      </div> 
    </div>
    
    <div class="col-lg-4 col-xs-6">
              <?php echo LteInfoBox::widget([
                      'bgIconColor'=>LteConst::COLOR_ORANGE,
                      'bgColor'=>'',
                      'number'=> Pedido::getTotalPedidos(),
                      'text'=>'<a href="/">Total de Pedidos</a>',
                      'icon'=>'fa fa-briefcase',
                      'showProgress'=>false,
                      'progressNumber'=>66,
                      //'description'=>'P'
                  ])?>

    <?php echo LteInfoBox::widget([
                      'bgIconColor'=>LteConst::COLOR_YELLOW,
                      'bgColor'=>'',
                      'number'=>Cliente::getTotalClientes(),
                      'text'=>'Clientes',
                      'icon'=>'fa fa-users',
                      'showProgress'=>false,
                      'progressNumber'=>66,
                      //'description'=>'P'
                  ])?>


      <?php echo LteInfoBox::widget([
                      'bgIconColor'=>LteConst::COLOR_GRAY,
                      'bgColor'=>'',
                      'number'=> Producto::getTotalProductos(),
                      'text'=>'Productos',
                      'icon'=>'fa fa-industry',
                      'showProgress'=>false,
                      'progressNumber'=>66,
                      //'description'=>'P'
                  ])?>


    </div>

