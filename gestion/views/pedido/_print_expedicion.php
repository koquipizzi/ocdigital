<?php
    
    use yii\helpers\Html;
    use app\models\Pedido;
?>

<div class="pagina">
    <div class="header">
        <table style="padding-top: 10px">
            <tr>
                <td>
                    <img src="<?php echo Yii::getAlias('@webroot').'/images/fp_logo.jpg'; ?>" width="50"  \/>
                </td>
                <td width="200">
                    <h2> Forestal Pico </h2>
                    <h3> Depósito Tandil </h3>
                    <h4> Lista de expedición de uso interno </h4>
                </td>
                <td width="300">
                    <?php
                        echo "<strong> Cliente: </strong>" ;
                        echo ' ( '.$model->CodigoCliente.' ) '.$model->getClienteRazonSocial();
                        echo "<br>";
                    ?>
                    
                    <?php
                        echo "<strong> Direccion de Entrega </strong>";
                        echo $model->ship_address_1;
                        echo "<br>";
                    ?>
                    <?php
                        echo "<strong> Localidad: </strong>";
                        echo $model->ship_city;
                        echo "<br>";
                    ?>
                    <?php
                        echo "<strong> Hora de Descarga: </strong>";
                        echo $model->hora_de_recepcion;
                        echo "<br>";
                    ?>
                    <?php
                        echo "<strong> Contacto y Telefono: </strong>";
                        echo $model->responsable_recepcion.' '.$model->telefono;
                        echo "<br>";
                    ?>
                </td>
                <td style="text-align:center">
                    <?php
                        echo "<h4>Pedido Nro </h4>";
                        echo "<h2>  $model->id  </h2>";
                        echo "<br>";
                    ?>
                </td>
            </tr>
        </table>
    </div>
</div>
<br>
<hr>
<table width="100%">
    <tr>
        <td width="100%">
            <div class="cl50">
                <?php foreach ($model->pedidoDetalles as $detalle) { ?>
                <table class="minimalistBlack">
                    <thead>
                     <tr>
                        <th style="text-align:center" width="70"> Codigó </th>
                        <th style="text-align:center" width="270"> Descripción </th>
                        <th style="text-align:center" width="70"> UM  </th>
                        <th style="text-align:center" width="50"> Cant </th>
                        <th style="text-align:center"> KG </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <td height="30" style = " text-align:center" > <?= $detalle->codigoproducto ?> </td>
                            <td> <?= $detalle->descripcionproducto ?> </td>
                            <td style = "text-align:center" > <?= $detalle->unidad->nombre_unidad ?> </td>
                            <td style = "text-align:center" > <?= $detalle->cantidad ?> </td>
                            <td style = "text-align:center" width="120">       </td>
                        </tr>
                        <tr >
                            <td style="text-align:left; border-top: 1px solid #000000; text-decoration: underline" colspan="5" height="35">
                                Lote:
                            </td>
                        </tr>
                    </tbody>
                </table>
                    <br>
                <?php } ?>
            </div>
        </td>
    </tr>
</table>
<hr>

