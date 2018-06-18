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
            <tr>
                <td style="text-align: left"  colspan="4">
                    <?php
                        echo "<h3>Formulario de Expedición</h3>";
                        echo "<p>DE USO INTERNO</p>";
                    ?>
                </td>
            </tr>
            </tr>
        </table>
    </div>
</div>
