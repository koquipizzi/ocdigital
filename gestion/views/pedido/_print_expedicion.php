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
                        echo "<strong> Dirección de Entrega: </strong>";
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
                        echo "<strong> Contacto y Teléfono: </strong>";
                        echo $model->responsable_recepcion.' - '.$model->telefono;
                        echo "<br>";
                    ?>
                </td>
                <td style="text-align:center">
                    <?php
                        echo "<h4>Pedido Nro. </h4>";
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
<pagebreak>
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
                        <h4> Hoja de Pedido </h4>
                        <br>
                        <?php
                            echo "<strong> Vendedor: </strong>";
                            echo strtoupper($model->GestorPedidoName);
                            echo "<br>";
                        ?>
                    </td>
                    <td width="300">
                        <?php
                            echo "<strong> Cliente: </strong>" ;
                            echo ' ( '.$model->CodigoCliente.' ) '.$model->ClienteRazonSocial;
                            echo "<br>";
                        ?>
                        <?php
                            echo "<strong> N° de Doc.: </strong>" ;
                            $documento = number_format($model->ClienteDocumento,0,'.','.');
                            echo $documento; 
                            echo "<br>";
                        ?>
                        <?php
                            echo "<strong>Dirección de Entrega: </strong>";
                            echo $model->ship_address_1;
                            echo "<br>";
                        ?>
                        <?php
                            echo "<strong> Hora de Entrega: </strong>";
                            echo $model->hora_de_recepcion;
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
                            echo "<strong> Contacto y Teléfono: </strong>";
                            echo $model->responsable_recepcion.' - '.$model->telefono;
                            echo "<br>";
                        ?>
                    </td>
                    <td style="text-align:center">
                        <?php
                            echo "<h4>Documento Nro.</h4>";
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
                    <table class="minimalistBlack">
                        <thead>
                        <tr>
                            <th colspan="3"></th>
                            <th colspan="3"> Precio Pactado</th>
                        </tr>
                            <tr>
                                <th style="text-align:center" width="50"> Cant. </th>
                                <th style="text-align:center" width="50"> UM  </th>
                                <th style="text-align:center" width="250"> Descripción </th>
                                <th style="text-align:center" width="70"> Precio Lista </th>
                                <th style="text-align:center" width="70"> Bonificación </th>
                                <th style="text-align:center"  width="70"> Precio </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($model->pedidoDetalles as $detalle) { ?>
                            <tr>
                                <?php $precio = number_format($detalle->precio_unitario,2,',','.');  ?>
                                <td height="30" style="text-align:center; border: 1px solid #000000;"> <?= $detalle->cantidad ?> </td>
                                <td height="30" style ="text-align:center; border: 1px solid #000000;"> <?= $detalle->unidad->nombre_unidad ?> </td>
                                <td height="30" style="text-align:center; border: 1px solid #000000;"> <?= $detalle->descripcionproducto ?>  </td>
                                <td height="30" style="text-align:right; margin-right: 2px; border: 1px solid #000000;"> <?= '$ '.$precio?></td>
                                <td height="30" style="text-align:center; border: 1px solid #000000;"> </td>
                                <td height="30" style="text-align:center; border: 1px solid #000000;"> </td>
                            </tr>
                            <?php } ?>
                        <tr>
                            <td colspan="3"></td>
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
    echo "<strong> Condición de Venta: </strong>";
    echo $model->cond_venta;
    echo   "<br>";
?>
