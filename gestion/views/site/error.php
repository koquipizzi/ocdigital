<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
$this->title = '';
?>

<section class="content">
      <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>

        <div class="error-content">
          <h3><i class="fa fa-warning text-yellow"></i> No se encontró la Página.</h3>

          <p>
            Lo sentimos no pudimos encontrar la pagina solicitada.
          </p>

          <div class="alert alert-warning">
              <?= Html::a('<i class="fa fa-arrow-left"></i> Volver a pagina de Inicio', ['index']) ?>
          </div>
        </div>
        <!-- /.error-content -->
      </div>
      <!-- /.error-page -->
    <div>
</div></section>
