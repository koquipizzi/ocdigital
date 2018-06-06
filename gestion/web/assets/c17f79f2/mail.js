


$(document).on('pjax:end', function () {
    var $btns = $("[data-toggle='popover-x']");
    if ($btns.length) {
        $btns.popoverButton();
    }
});


$(document).on('ready pjax:success', function () {


    $(".borrarMail").on('click', function (e) {
        e.preventDefault();
        var mail = $(this).data("mail");
        var key = $(this).data("key");
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
                    callback: function () {
                        $.ajax(
                            url,
                            {
                                data: { key: key, mail: mail, id: id },
                                type: "POST",
                                error: function (XMLHttpRequest, textStatus, errorThrown) {
                                    bootbox.alert("No se puede eliminar esa entidad.");
                                }
                            }).done(function (data) {
                                $.pjax.reload({ container: "#mails" });
                                var n = noty({
                                    text: "Mail eliminado con éxito!",
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



});

