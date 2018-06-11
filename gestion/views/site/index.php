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
?>
<?php      
                Modal::begin([
                        'header' => '<h4>Events</h4>',
                        'id'     => 'model',
                        'size'   => 'model-lg',
                ]);
                
                echo "<div id='modelContent'></div>";
                Modal::end();
?>

<?php
  $events = array();
  $e = Event::find()->asArray()->all();
  //var_dump($e); die;

  ?>

  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Pedidos Realizados</h3>
        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <div class="box-body">
  
    
      </div>
  </div> 
<div class="row">

  <div class="col-lg-3 col-xs-6">
    <?php echo LteSmallBox::widget([
                       'type'=>LteConst::COLOR_AQUA,
                       'title'=> Pedido::getTotalPedidosPendientes(),
                       'text'=>'Órdenes Pendientes',
                       'icon'=>'fa fa-shopping-cart',
                       'footer'=>'Más',
                       'link'=>Url::to(['pedido/index'])
    ]);?>
  </div>

  <div class="col-lg-3 col-xs-6">
    <?php echo LteSmallBox::widget([
                       'type'=>LteConst::COLOR_ORANGE,
                       'title'=> Cliente::getTotalClientes(),
                       'text'=>'Clientes',
                       'icon'=>'fa fa-users',
                       'footer'=>'Más',
                       'link'=>Url::to(['cliente/index'])
    ]);?>
  </div>

  <div class="col-lg-3 col-xs-6">
    <?php echo LteSmallBox::widget([
                       'type'=>LteConst::COLOR_OLIVE,
                       'title'=>  Producto::getTotalProductos(),
                       'text'=>'Productos',
                       'icon'=>'fa fa-shopping-basket',
                       'footer'=>'Más',
                       'link'=>Url::to(['producto/index'])
    ]);?>
  </div>

  <div class="col-lg-3 col-xs-6">
    <?php
        $estado = Comanda::getEstadoComanda();
        if (empty($estado)) {
            echo LteSmallBox::widget([
                        'type'=> LteConst::COLOR_RED,
                        'title'=> 'Inactiva' ,
                        'text'=>'Estado de Comanda',
                        'icon'=>'fa fa-ban',
                        'footer'=>'Más',
                        'link'=>Url::to(['comanda/index'])]);
          }else {
              echo LteSmallBox::widget([
                        'type'=> LteConst::COLOR_GREEN,
                        'title'=> 'Activa' ,
                        'text'=>'Estado de Comanda',
                        'icon'=>'fa fa-play',
                        'footer'=>'Más',
                        'link'=>Url::to(['comanda/index'])]);
          }
    ?>
  </div>

</div>

<div class="row">
  <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Comandas</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
          <?php
            $comandas = new ComandaSearch();
            $dataProvider = $comandas->search(Yii::$app->request->queryParams);
            $dataProvider->pagination = ['pageSize' => 5];
          ?>
          <?= GridView::widget([
              'dataProvider' => $dataProvider,
              'columns' => [
                [
                  'label' => 'Nro. Comanda',
                  'attribute' => 'id',
                  'headerOptions' => ['style' => 'width:10%'],
                ],
                [
                  'label' => 'Fecha de Producción',
                  'attribute' => 'fecha_produccion',
                  'headerOptions' => ['style' => 'width:30%'],
                  'contentOptions' => ['style' => 'width:20%;'],
                  'format' => ['date', 'php:d/m/Y'],
                ],
                [
                  'label' => 'Acción',
                  'attribute' => 'id',
                  'contentOptions' => ['style' => 'width:8%'],
                  'format' => 'raw',
                  'value'=>function ($data) {
                      return Html::a('<span class="fa fa-eye"></span>',Url::to(["comanda/view/", 'id' => $data['id']]));
                  },
                ]
              ]]);
          ?>
        </div>
      </div>
  </div>
  <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Pedidos</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
          <?php
            $Pedidos = new PedidoSearch();
            $dataProviderP = $Pedidos->search(Yii::$app->request->queryParams);
            $dataProviderP->pagination = ['pageSize' => 5];
          ?>
          <?= GridView::widget([
              'dataProvider' => $dataProviderP,
              'columns' => [
                [
                  'label' => 'Nro. Pedido',
                  'attribute' => 'id',
                  'headerOptions' => ['style' => 'width:10%'],
                ],
                [
                'label' => 'Precio Total',
                'attribute' => 'precio_total',
                'format' => ['currency'],
                'contentOptions' => ['class' => 'text-right'],
                'headerOptions' => ['class' => 'text-right'],
                  'headerOptions' => ['style' => 'width:15%']
                ],
                [
                  'label'=>'Cliente',
                  'attribute' => 'razon_social',
                  'value' => 'cliente.razon_social'
                ],
                [
                  'label' => 'Acción',
                  'attribute' => 'id',
                  'contentOptions' => ['style' => 'width:8%'],
                  'format' => 'raw',
                  'value'=>function ($data) {
                      return Html::a('<span class="fa fa-eye"></span>',Url::to(["pedido/view/", 'id' => $data['id']]));
                  },
                ]
              ] ]);?>
        </div>
      </div>
  </div>
</div>
