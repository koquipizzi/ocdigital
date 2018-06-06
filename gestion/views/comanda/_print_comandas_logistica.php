<?php
use yii\helpers\Html;
use app\models\Pedido;
?>
<br>
<h2> Logística de Pedidos </h2>
<div class="pagina">
    <div class="header">
        <table>
            <tr>
                <td>
                    <strong>FECHA REPARTO: </strong>
                </td>
                <td>
                 <?php
                        $date = new \DateTime($model->fecha_produccion);
                        echo $date->format('d-m-Y');
                  ?>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>Fecha de Entrega: </strong>
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
<table class="minimalistBlack">
    <thead>
        <tr>
            <td class="titulo" width="20%">NOMBRE DE FANTASÍA</td>
            <td class="titulo" width="30%">DIRECCIÓN</td>
            <td class="titulo" width="10%">ENTREGA</td>
            <td class="titulo" width="20%">CONTACTO</td>
            <td class="titulo" width="20%">TELÉFONO</td>
        </tr>
    </thead>
    <?php
    $pedidos = $model->pedidos;
    $pedidosPendientes = sizeof($pedidos);
    $fila = $pedidosPendientes;
    foreach ($pedidos as $pedido) {
    ?>
    <tbody>
        <tr>
            <td><?= $pedido->getClienteRazonSocial(); ?></td>
            <td><?php echo $pedido->ship_address_1; if (!empty( $pedido->ship_address_2)){echo $pedido->ship_address_2; echo',';} ?></td>
            <td><?php echo $pedido->cliente->hora_reparto; ?></td>
            <td><?php echo $pedido->getContacto(); ?></td>
            <td><?php echo $pedido->getTelefono(); ?></td>
        </tr>

    <?php  } ?>
    </tbody>
</table>
