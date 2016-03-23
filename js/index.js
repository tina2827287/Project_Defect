var globalStartID = 0;
var number = $('input[name="number"]');

$(document).ready(function () {

    $('.accro').accordion({
        collapsible: true,
        active: false,
        animate: 200
    });

    ////////////////
    $('#more').click(function () {

        var Y = $('#Year').val();
        var M = $('#Month').val();
        var D = $('#Day').val();

        var StartID = globalStartID;
        var EndID = $('#EndID').val();
        var dest = 'search_date.php';

        getData(Y, M, D, StartID, dest, '', 'default');
        globalStartID += 10;

        if (EndID < globalStartID && EndID != 0) {
            //            <&!=0 more diseapear
            $('#more').fadeOut();
        }
    });
    //////////////////////

    $('#submit').submit(function () {
        var num = $('input[name="num"]');
        console.log(num);
        var datanum = num.val(); //這行抓到22
        console.log(datanum);

        var Y = $('#Year').val();
        var M = $('#Month').val();
        var D = $('#Day').val();

        var StartID = globalStartID;
        var EndID = $('#EndID').val();
        var dest = 'search_num.php';

        getData(Y, M, D, StartID, dest, datanum, 'keyword');


        return false;
    });




    /////////////////////
});