<table width="100%" style="padding-top: 145px">
    <tr>
        <td width="100%">
            <div class="cl50">
                <table class="minimalistBlack">
                    <thead>
                    <tr>
                        <th colspan="4"></th>
                        <th colspan="3"> Precio Pactado</th>
                    </tr>
                    <tr>
                        <th style="text-align:center" width="40"> Cant. </th>
                        <th style="text-align:center" width="40"> UM  </th>
                        <th style="text-align:center" width="50"> Código </th>
                        <th style="text-align:center" width="250"> Descripción </th>
                        <th style="text-align:center" width="70"> Precio Lista </th>
                        <th style="text-align:center" width="60"> Bonificación </th>
                        <th style="text-align:center"  width="60"> Precio </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($model->pedidoDetalles as $detalle) { ?>
                        <tr>
                            <?php $precio = number_format($detalle->precio_unitario,2,',','.');  ?>
                            <td height="30" style="text-align:center; border: 1px solid #000000;"> <?= $detalle->cantidad ?> </td>
                            <td height="30" style ="text-align:center; border: 1px solid #000000;"> <?= $detalle->unidad->nombre_unidad ?> </td>
                            <td height="30" style="text-align:center; border: 1px solid #000000;"> <?= $detalle->codigoproducto ?> </td>
                            <td height="40" style="text-align:center; border: 1px solid #000000;"> <?= $detalle->descripcionproducto ?>  </td>
                            <td height="30" style="text-align:right; margin-right: 2px; border: 1px solid #000000;"> <?= '$ '.$precio?></td>
                            <td height="30" style="text-align:center; border: 1px solid #000000;"> </td>
                            <td height="30" style="text-align:center; border: 1px solid #000000;"> </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="4"></td>
                        <td height="70" style="text-align: left; text-decoration: underline; border-left: 1px solid #000000;">Autorización: </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </td>
    </tr>
</table>
<hr>
<?php
    echo "<strong>Vendedor: </strong>" . strtoupper($model->GestorPedidoName);
    echo   "<br>";
?>
<?php
    echo "<strong> Condición de Venta: </strong>";
    echo $model->cond_venta;
    echo   "<br>";
?>
<?php
    echo "<strong style='font-size: 22px'> Notas: </strong>";
    echo "<strong> $model->notas </strong>";
    echo "<br>";
?>