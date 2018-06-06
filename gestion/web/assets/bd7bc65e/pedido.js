$(".subir_entrega").on("click", function (e) {
    e.preventDefault();
    var orden = $(this).data("id");
    var url = "/index.php?r=pedido/subir";

    $.ajax(
        url,
        {
            data: { orden: orden },
            type: "GET",


        }).done(function (data) {
              $.pjax.reload({ container: "#pedidos" });

        });

});

$(".bajar_entrega").on("click", function (e) {
    e.preventDefault();
    var orden = $(this).data("id");
    var url = "/index.php?r=pedido/bajar";

    $.ajax(
        url,
        {
            data: { orden: orden },
            type: "GET",


        }).done(function (data) {
             $.pjax.reload({ container: "#pedidos" });
        });

});


$(document).on('ready pjax:success', function () {

    $(".subir_entrega").on("click", function (e) {
        e.preventDefault();
        var orden = $(this).data("id");
        // var key = $(this).data("key");
        //  var id = $(this).data("id");
        var url = "/index.php?r=pedido/subir";

        $.ajax(
            url,
            {
                data: { orden: orden },
                type: "GET",


            }).done(function (data) {
                //  $.pjax.reload({ container: "#pedidos" });

            });

        $.pjax.reload({ container: "#pedidos" });  //Reload GridView
    });

    $(".bajar_entrega").on("click", function (e) {
        e.preventDefault();
        var orden = $(this).data("id");
        var url = "/index.php?r=pedido/bajar";

        $.ajax(
            url,
            {
                data: { orden: orden },
                type: "GET",


            }).done(function (data) {
                $.pjax.reload({ container: "#pedidos" });
            });

    });





});

