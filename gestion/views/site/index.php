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
use yii2fullcalendar\yii2fullcalendar;

$this->title = "Sistema de Gestión de Toma de Pedidos";

$this->registerJs('var ajaxHomeIndex = "' .Url::to(['pedido/cantidad']). '";', \yii\web\View::POS_HEAD);
$js = 'function refresh() {
        $.ajax({
            url: ajaxHomeIndex,
            success: function(data) {
                console.log(data);
                $("#cant").html(data.pendientes);
            }
        });
      //  $.pjax.reload({container:"#cant"});
        setTimeout(refresh, 50000); // restart the function every 50 seconds
        }
        refresh();';

 $this->registerJs($js, $this::POS_READY);

Modal::begin([
            'header' => '<h4></h4>',
            'id'     => 'model',
            'size'   => 'model-lg',
            'closeButton' => ['id' => 'close-button'],   
    ]);
    
    echo "<div id='modelContent'></div>";
    
Modal::end();

?>


<script type="text/javascript">
		$( document ).ready( function ( e ) {
      alert('dddd');
      $('.fc-license-message').hide();
		});
</script>


<?php
  $events = array();
  $e = Event::find()->asArray()->all();
  //var_dump($e); die;

  ?>

  <div class="row">
    <div class="col-lg-8 col-xs-12">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Pedidos Realizados</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body" style="height: auto">
      
          <?php
          $JSEventClick = '
            function(event, jsEvent, view) {
            var id = event.id;
            $.get("index.php?r=pedido/viewpop", { "id": id }, function (data) {
            $("#model").find(".modal-header").find("h4").html("Detalle de pedido Nro: "+ id );
            $("#model").modal("show")
                .find("#modelContent")
                .html(data);
              })
            }
            ';
              echo \yii2fullcalendarscheduler\yii2fullcalendarscheduler::widget([
                'events'=> $e,
                'id' => 'calendar',
                'options' => [
                        'navLinks'=> true,
                ],
                'clientOptions' =>
                    ['fixedWeekCount' => false, 
                    'weekNumbers' => true, 
                    'editable' => true, 
                    'eventLimit' => true, 
                    'eventLimitText' => 'pedidos más',
                    
                  'eventClick' => new \yii\web\JsExpression($JSEventClick)
                    ]
             //   'ajaxEvents' => Url::to(['/timetrack/default/jsoncalendar'])
              ]);
          ?>
          </div>
      </div> 
    </div>
    
    <div class="col-lg-4 col-xs-12">
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

