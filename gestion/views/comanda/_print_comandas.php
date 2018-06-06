<?php
use yii\helpers\Html;
use app\models\Pedido;
?>
<h2> Pedidos en Comanda </h2>
<div class="pagina">
    <div class="header">
        <table>
            <tr>
                <td>
                    <strong>Comanda Nro: </strong>
                </td>
                <td>
                  <?php
                        echo $model->id;
                  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Fecha de Producción: </strong>
                </td>
                <td>
                  <?php
                        $date = new \DateTime($model->fecha_produccion);
                        echo $date->format('d-m-Y');
                  ?>
                </td>
            </tr>
            <?php if (!empty($model->nota)) { ?>
            <tr>
                <td>
                    <strong>Notas: </strong>
                </td>
                <td>
                   <?php echo $model->nota; ?>
                </td>
            </tr>
            <?php } ?>
        </table>
    </div>
</div>
<br>
<hr>
<?php
  $pedidos = $model->pedidos;
  $pedidosPendientes = sizeof($pedidos);
  $fila = $pedidosPendientes;
  foreach ($pedidos as $pedido) {
?>
  <table width="100%">
  <tr>
    <td width="100%">
      <div class="cl50">
        <table class="minimalistBlack">
            <thead>
                <tr>
                <th  style="text-align:left"><?= $pedido->getClienteRazonSocial(); ?> </th>
                <th style="text-align:right"> Cantidad </th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($pedido->pedidoDetalles as $detalle) { ?>
              <tr>
                  <td> <?= $detalle->descripcionproducto ?> </td>
                  <td style = "text-align:right" > <?= $detalle->cantidad ?> </td>
              </tr>
              <?php } ?>
              <!--<tr>
                <td colspan="2">
                        <b>Dirección Envío:</b><br>
                        <?php /*echo $pedido->ship_address_1; echo','; */?><br>
                        <?php /*if (!empty( $pedido->ship_address_2)){echo $pedido->ship_address_2; echo',';}  */?>
                        <?php /*echo $pedido->ship_city; echo','; */?><br>
                        <?php /*echo $pedido->ship_postcode; echo'.'; */?><br>
                </td>
              </tr>-->
            </tbody>
        </table>
      </div>
    </td>
  </tr>
</table>
<hr>
<?php  } ?>
