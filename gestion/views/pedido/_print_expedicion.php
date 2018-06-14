<?php
    
    use yii\helpers\Html;
    use app\models\Pedido;
?>

<table width="100%" style="padding-top: 120px">
    <tr>
        <td width="100%">
            <div class="cl50">
                <?php foreach ($model->pedidoDetalles as $detalle) { ?>
                <table class="minimalistBlack">
                    <thead>
                     <tr>
                        <th style="text-align:center" width="70"> Código </th>
                        <th style="text-align:center" width="270"> Descripción </th>
                        <th style="text-align:center" width="70"> UM.  </th>
                        <th style="text-align:center" width="50"> Cant. </th>
                        <th style="text-align:center"> KG. </th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <td height="30" style = " text-align:center" > <?= $detalle->codigoproducto ?> </td>
                            <td> <?= $detalle->descripcionproducto ?> </td>
                            <td style = "text-align:center" > <?= $detalle->unidad->nombre_unidad ?> </td>
                            <td style = "text-align:center" > <?= $detalle->cantidad ?> </td>
                            <td style="text-align:right; margin-right: 2px; border-left: 1px solid #000000;" width="120">       </td>
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
<?php
    echo "<strong style='font-size: 22px'> Notas: </strong>";
    echo "<strong> $model->notas </strong>";
    echo "<br>";
?>
<pagebreak>
<table width="100%" style="padding-top: 120px">
    <tr>
        <td width="100%">
            <div class="cl50">
                <?php foreach ($model->pedidoDetalles as $detalle) { ?>
                    <table class="minimalistBlack">
                        <thead>
                        <tr>
                            <th style="text-align:center" width="70"> Código </th>
                            <th style="text-align:center" width="270"> Descripción </th>
                            <th style="text-align:center" width="70"> UM.  </th>
                            <th style="text-align:center" width="50"> Cant. </th>
                            <th style="text-align:center"> KG. </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr >
                            <td height="30" style = " text-align:center" > <?= $detalle->codigoproducto ?> </td>
                            <td> <?= $detalle->descripcionproducto ?> </td>
                            <td style = "text-align:center" > <?= $detalle->unidad->nombre_unidad ?> </td>
                            <td style = "text-align:center" > <?= $detalle->cantidad ?> </td>
                            <td style="text-align:right; margin-right: 2px; border-left: 1px solid #000000;" width="120">       </td>
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
<?php
    echo "<strong style='font-size: 22px'> Notas: </strong>";
    echo "<strong> $model->notas </strong>";
    echo "<br>";
?>
