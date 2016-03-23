var globalStartID = 0;

$(document).ready(function () {


    $('.accro').accordion({
        collapsible: true,
        active: false
    });


    $('#more').click(function () {

        var Y = $('#Year').val();
        var M = $('#Month').val();
        var D = $('#Day').val();

        var StartID = globalStartID;
        var EndID = $('#EndID').hide();
        var searchTp = 'default';
        var dest = 'search_date.php';

        getData(Y, M, D, StartID, dest, '', searchTp);
        globalStartID += 10;

        if (EndID < globalStartID && EndID != 0) {
            //            <&!=0 more diseapear
            $('#more').hide();
        }
    });

    /////輸入框sumbit

    $("#num").keypress {

        code = (e.keyCode ? e.keyCode : e.which);
        if (code == 13) {
            $("searchform").submit();
            var N = $('input[name="num"]').val();

            var dest = 'search_num.php';
            getData(Y, M, D, StartID, dest, N, '');

            if (EndID < globalStartID && EndID != 0) {
                //            <&!=0 more diseapear
                $('#more').hide();
            }
        }


    });





});