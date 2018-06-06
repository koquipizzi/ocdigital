<?php
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Categoria;
use app\models\Comanda;
use app\models\ComandaDetalleSearch;
?>
<body>

<?php

$summaryOptions = ['display' => 'none'];

$cat = new Categoria();
$modelCat = $cat->find()->all();
$searchModel = new ComandaDetalleSearch();
$cantCategorias = Comanda::getCantCategorias($model->id);

foreach ($modelCat as $categoria) {

  if (!empty($categoria->nombre)){ 
    $dataProvider = $searchModel->searchGroupByProdCat($model->id,$categoria->id);
 
  if (sizeof($dataProvider->getModels()) > 0) {
    $html = "";
    if ($cantCategorias > 1) {
        $html .= "<div style='page-break-after:always'>" ;
        $cantCategorias--; 
    } else {
        $html .= "<div style='page-break-after:avoid'>" ;
    }
    echo $html; // imprime <div>

?>
      <br>
      <h2>Detalle Productos en Comanda</h2>
      <hr>
        <?php if (!empty($model->nota)) { ?>
            <strong>Notas: </strong>
            <?php echo $model->nota; ?>
        <?php } ?>

        <div class="row" >
        
              <br>
              <h2><?= $categoria->nombre; ?></h2>
                  <?= GridView::widget(['dataProvider' => $dataProvider,
                  'options' => $summaryOptions,
                  'summary' => '',
                  'columns' => [
                      ['attribute' => 'Producto','value' => 'producto.nombre','contentOptions' => ['style' => 'text-align:left;']],
                      [ 'attribute' => 'Cantidad', 'value' => 'cantidad_produccion',  'contentOptions' => ['style' => 'text-align:right;']],
                  ] ]);?>
        
          </div> 
      </div> 
<?php 
  //  echo '<pagebreak />';
 
 ?>
 <?php } ?>
   
<?php 
  }
  
}
?>
</body>
