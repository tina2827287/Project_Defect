var globalStartID = 0;

$(document).ready(function () {

    /*    $(window).scroll(function () {

            if ($(this).scrollTop() > 410) {

                $("#top-bar").show();

            } else {
                $("#top-bar").remove();
            }

        });
    */


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
        var dest = 'search_date.php';

        getData(Y, M, D, StartID, dest, '', 'default');
        globalStartID += 10;

        if (EndID < globalStartID && EndID != 0) {
            //            <&!=0 more diseapear
            $('#more').hide();
        }
    });

});