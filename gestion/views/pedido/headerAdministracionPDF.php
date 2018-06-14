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