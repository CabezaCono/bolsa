$(document).ready(function() {
    $('#table-data').DataTable({
        "language":{
            "url":"//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
        },
        dom: 'lfrtp',
        'pageLength': 25,
        'lengthMenu': [[10, 20, 25, 50, -1], [10, 20, 25, 50, 'Todos']],
        fixedHeader: true,
        "initComplete": function(settings, json) {
            $('.dataTables_filter input').attr('placeholder', 'Ej: ejemplo@dominio.com').attr("name","datos");
        }



    });

    $(".select2").select2({
        width: '100%'

    });

    $('[data-toggle="popover"]').popover();

    $('.logout-button').click(function () {

        $("#logout-form").submit();

    });
    
    $('.fullScreen-button').click(function () {
        fullScreen();
    });

    $(".slimScroll").slimScroll({
        height: "350px"
    });

    $(".slimScrollOffer").slimScroll({
        height: "50px"
    });

    $(".check-padre").click(function () {
        var id = $(this).attr("id");
        if(this.checked) {
            // Iterate each checkbox
            $(':checkbox[id="'+id+'"]').each(function() {
                this.checked = true;
            });
        }else{
            $(':checkbox[id="'+id+'"]').each(function() {
                this.checked = false;
            });
        }
    });

} );


function fullScreen(elem) {
    var elem = elem || document.documentElement;
    if (!document.fullscreenElement && !document.mozFullScreenElement &&
        !document.webkitFullscreenElement && !document.msFullscreenElement) {
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.msRequestFullscreen) {
            elem.msRequestFullscreen();
        } else if (elem.mozRequestFullScreen) {
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
            elem.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
    } else {
        if (document.exitFullscreen) {
            document.exitFullscreen();
        } else if (document.msExitFullscreen) {
            document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
            document.webkitExitFullscreen();
        }
    }
}