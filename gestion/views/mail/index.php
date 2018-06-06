<?php

use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\popover\PopoverX;
use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\editable\Editable;
use kartik\spinner\Spinner;
use eleiva\noty\Noty;
use xj\bootbox\BootboxAsset;
BootboxAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\MailSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('app', 'Mails');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mail-index">
  <div class="box box-warning with-border">
    <div class="box-body">
    <?php Pjax::begin(['id' => 'mails']); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'accion',
            [
                'attribute' => 'Mails',
                'filter' => false,
                'format' => 'raw',
                 'value' => function ($model) {
                    $echo = "";
                    $mails = $model->mails;
                    $mails = explode(';', $mails);
                    $form = '<form id="kv-login-form" class="form-vertical" action="/index.php?r=mail/edit">
                    <input type="hidden" name="_csrf" value="jUza6moXT7HDpHpr5H_Y56k_y_IdH0BNh_HshXsWA6f4JoPSLlAV5I_XLCWIKY-uxHCCtXxpOBv-mq-1JE9Z_Q==">
                    <div class="form-group field-mail-mails">';
                    foreach ($mails as $key=>$em){
                        $editable = Editable::widget([
                            'name'=>'mail',
                            'asPopover' => false,
                            'value'=>$em,
                            'formOptions' => [
                                'method' => 'post',
                                'action' => ['mail/edit'] ],
                            'pluginEvents' => [
                                'editableSuccess'=>"function(event, val, form, data) { $.pjax.reload({container: '#mails'}); }",
                            ],
                            'header' => FALSE,
                            'size'=>'xs',
                       //     'options' => ['class'=>'form-control', 'placeholder'=>'Cantidad...'],
                            'afterInput'=>
                                    Html::hiddenInput('key',$key).
                                    Html::hiddenInput('id',$model->id),
                        ]);
                         $echo = $echo.$editable.Html::a('<span class="glyphicon glyphicon-trash borrarMail" data-key="'.$key.'" data-mail="'.$em.'" data-id="'.$model->id.'"></span>')."<br />";
                    }
                        return $echo;
                 },
              ],


            [

                    'class'    => 'yii\grid\ActionColumn',
                    'template' => ' {leadDelete}',
                    'buttons'  => [

                        'leadDelete' => function ($url, $model) {
                            $content = '<form id="kv-login-form2" class="form-vertical">

                            <div class="form-group field-mail-mails">
                            <input type="hidden" id="mail-evento" class="form-control" name="Mail[evento]" value="'.$model->id.'">
                            <input type="email" id="mail-mails" class="form-control" name="Mail[mails]" placeholder="Ingrese email...">

                            <div class="help-block"></div>
                            </div></form>';

                            $userPopover = '<div class="navbar-form">' . PopoverX::widget([
                                'id' => 'popMail',
                                'placement' => PopoverX::ALIGN_BOTTOM_RIGHT,
                                'size' => 'md',
                                'content' => $content,
                                'header' => '<i class="glyphicon glyphicon-plus"></i> Agregar E-mail',
                                'footer' => Html::button('Agregar', [
                                        'class' => 'btn btn-sm btn-primary click',
                                    //    'onclick' => '$("#kv-login-form2").trigger("submit")'
                                    ]) . Html::button('Restablecer', [
                                        'class' => 'btn btn-sm btn-default',
                                        'onclick' => '$("#kv-login-form2").trigger("reset")'
                                    ]),
                                'toggleButton' => [
                                    'label' => 'Agregar email' . Html::tag('span', '', ['class' => 'glyphicon glyphicon-mail', 'style' => 'padding-left: 10px']),
                                    'class'=>'btn btn-default openPop'
                                ]
                            ]) . '</div>';

                            return $userPopover;
                        },

                    ],
            ],
      //      ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
</div>
</div>

<?php

$js= <<<JS
        $(".borrarMail").on('click',function(e){
                    e.preventDefault();
                    var  mail = $(this).data("mail");
                    var  key = $(this).data("key");
                    var id = $(this).data("id");
                    var url = "/index.php?r=mail/borrar";
                    bootbox.dialog({
                                message: "¿Confirma que desea eliminar mail?",
                                title: "Sistema de Gestión de Comandas",
                            //      className: "modal-info modal-center",
                                buttons: {
                                        success: {
                                                label: "Aceptar",
                                                className: "btn-primary",
                                                callback: function() {
                                                $.ajax(
                                                    url,
                                                    {
                                                    data: {key: key, mail: mail, id: id },
                                                    type: "POST",
                                                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                                                        bootbox.alert("No se puede eliminar esa entidad.");
                                                    }
                                                }).done(function(data) {
                                                    $.pjax.reload({container: "#mails"});
                                                    var n = noty({
                                                    text: "Mail eliminado.",
                                                    type: "success",
                                                    class: "animated pulse",
                                                    layout: "topRight",
                                                    theme: "metroui",
                                                    timeout: 2000, // delay for closing event. Set false for sticky notifications
                                                    force: false, // adds notification to the beginning of queue when set to true
                                                    modal: false, // si pongo true me hace el efecto de pantalla gris
                                            //       maxVisible  : 10
                                                    });
                                                });
                                            }
                                        },
                                    cancel: {
                                        label: "Cancelar",
                                        className: "btn-danger",
                                    }
                                }
                            });
            });


    /*$('#kv-login-form2').submit( function (e) {
        alert('entra');
        e.preventDefault();
         $.pjax.submit(e, '#mails', {
        'push': fasle,
        'replace': true,
        'timeout': 5000,
        'scrollTo': 0,
        'maxCacheLength': 0
    });
    $.pjax.reload({ container: "#mails" });
    });*/

    $('.click').on('click', function (e) {
        e.preventDefault();
        var url = 'index.php?r=mail/add';
        var mail = $(this).data("mail");
        var key = $(this).data("key");
        var id = $(this).data("id");
        var p = $('#popMail');

        $.ajax({
            type: "POST",
            url: url,
            dataType: "JSON",
            data: $('#kv-login-form2').serialize(),
            success: function (response) {
                if (response.rta === 'ok') {
                    p.popoverX('toggle');
                    $.pjax.reload({ container: "#mails" });
                    var n = noty({
                        text: response.message,
                        type: 'success',
                        class: 'animated pulse',
                        layout: 'topRight',
                        theme: 'metroui',
                        timeout: 3000, // delay for closing event. Set false for sticky notifications
                        force: false, // adds notification to the beginning of queue when set to true
                        modal: false, // si pongo true me hace el efecto de pantalla gris
                    });
                    //        p.popoverX('hide');

                } else if (response.rta === 'error') {
                    //   $('.field-informenomenclador-cantidad').removeClass('has-success');
                    ///   $('.field-informenomenclador-cantidad').addClass('has-error');
                    //    $('.field-informenomenclador-cantidad .help-block').html(response.message.cantidad[0]);
                }
                else { // el nomenclador ya se encuentra agregado
                    var n = noty({
                        text: response.message,
                        type: 'error',
                        class: 'animated pulse',
                        layout: 'topRight',
                        theme: 'metroui',
                        timeout: 3000, // delay for closing event. Set false for sticky notifications
                        force: false, // adds notification to the beginning of queue when set to true
                        modal: false, // si pongo true me hace el efecto de pantalla gris
                    });

                }
            }
        });
});



JS;

$this->registerJs($js);


$this->registerJsFile('@web/js/mail.js', ['depends' => [yii\web\AssetBundle::className()]]);
?>
   