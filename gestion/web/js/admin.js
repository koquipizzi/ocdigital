$(function () {

    $('#modelButton').click(function () {
        $('.modal').modal('show')
            .find('#modelContent')
            .load($(this).attr('value'));
    });

    $(document).on('click', '.fc-content', function () {
        
        var id = $(this).attr('data-id');
        
        $.get('index.php?r=pedido/viewpop', { 'id': id }, function (data) {
          //  alert(data);
            $('#model').find('.modal-header').html('Detalle de pedido Nro: '+ id);
            $('#model').modal('show')
                .find('#modelContent')
                .html(data);
        })
    });
});