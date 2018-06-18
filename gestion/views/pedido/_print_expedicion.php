<?php
    
    use yii\helpers\Html;
    use app\models\Pedido;
?>


<htmlpageheader  name="HeaderAdministracion">

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
                    </td>
                    <td width="300">
                        <?php
                            echo "<strong> Cliente: </strong>" ;
                            echo ' ( '.$model->CodigoCliente.' ) '.$model->ClienteRazonSocial;
                            echo "<br>";
                        ?>
                        <?php
                            echo "<strong> N° de Doc.: </strong>" ;
                            if (!empty($model->ClienteDocumento)){
                                $documento = number_format($model->ClienteDocumento,0,'.','.');
                                echo $documento;
                            }
                            echo "<br>";
                        ?>
                        <?php
                            echo "<strong>Dirección de Entrega: </strong>";
                            echo $model->ship_address_1;
                            echo "<br>";
                        ?>
                        <?php
                            echo "<strong> Localidad: </strong>";
                            echo $model->ship_city;
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
                <tr>
                    <td style="text-align: left"  colspan="4">
                        <?php
                            echo "<h4>Formulario de Administración</h4>";
                            echo "<p>DE USO INTERNO</p>";
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <hr>

</htmlpageheader>

<?php $cont = 0; foreach ($model->pedidoDetalles as $detalle) {
    if ($cont == 0) {
        echo  "<table width=\"100%\" style=\"padding-top: 140px\">";
    }else{
        echo  "<table width=\"100%\" style=\"padding-top: 10px\">";
    }
    ?>
    <tr>
        <td width="100%">
            <table class="minimalistBlack" >
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
        </td>
    </tr>
    </table>
    <?php $cont = $cont + 1; if ($cont > 6) { echo "  <pagebreak style='padding-top: 140px'> " ; $cont = 0;}  } ?>
<?php
    echo "<hr>";
    echo "<strong style='font-size: 22px'> Notas: </strong>";
    echo "<strong> $model->notas </strong>";

?>

<pagebreak resetpagenum="1">
    
    <?php $cont = 0; foreach ($model->pedidoDetalles as $detalle) {
        if ($cont == 0) {
            echo  "<table width=\"100%\" style=\"padding-top: 140px\">";
        }else{
            echo  "<table width=\"100%\" style=\"padding-top: 10px\">";
        }
        ?>
        <tr>
            <td width="100%">
                <table class="minimalistBlack" >
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
            </td>
        </tr>
        </table>
        <?php $cont = $cont + 1; if ($cont > 6) { echo "  <pagebreak style='padding-top: 140px'> " ; $cont = 0;}  } ?>
    <?php
        echo "<hr>";
        echo "<strong style='font-size: 22px'> Notas: </strong>";
        echo "<strong> $model->notas </strong>";
    
    ?>

    <pagebreak resetpagenum="1">

        <sethtmlpageheader name="HeaderAdministracion" page="ALL"  value="ON" show-this-page="1" />

        <table width="100%" style="padding-top: 170px; page-break-inside:auto">
            <tr>
                <td width="100%">
                    <div class="cl50">
                        <table class="minimalistBlack" style="page-break-inside:auto">
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
                            <?php $cont = 0; foreach ($model->pedidoDetalles as $detalle) { ?>
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
                                <?php $cont = $cont +1 ;} ?>
                            <tr>
                                <td colspan="4"></td>
                                <td height="40" style="text-align: left; text-decoration: underline; border-left: 1px solid #000000;">Autorización:  </td>
                                <td style="text-align: left"><?= $model->getResponsble() ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <div class="datos">
            
            <?php
                if ($cont > 14 ){
                    echo "  <pagebreak >" ;
                    echo "<div style='padding-top: 170px'>";
                }
                
                echo "<strong>Vendedor: </strong>" . strtoupper($model->GestorPedidoName);
                echo   "<br>";
                
                echo "<strong> Condición de Venta: </strong>";
                echo $model->cond_venta;
                echo   "<br>";
                
                echo "<strong style='font-size: 22px'> Notas: </strong>";
                echo "<strong> $model->notas </strong>";
                echo "<br>";
                echo "</div>";
            ?>

        </div>