var globalStartID = 0;
var number = $('input[name="number"]');

$(document).ready(function () {


    /////Default Action 日期要取//////


    $('.accro').accordion({
        collapsible: true,
        active: false,
        animate: 200
    });


    $('#date').datepicker({
        dateFormat: 'yy-mm-dd',
        showAnim: 'slideDown'

    });

    ////////已在查詢 按more看更多////////
    $('#more').click(function () {

        var Date = $('#date');
        var chooseStatus = $('input:radio:checked[name="R"]').val();

        console.log(chooseStatus);
        var StartID = globalStartID;
        var EndID = $('#EndID').val();
        var dest = 'search_date.php';

        getData(Date, StartID, dest, chooseStatus, '', 'default');
        globalStartID += 10;

        if (EndID == 1) {
            //            <&!=0 more diseapear
            $('#more').fadeOut();
        }
    });


    //////////表單送出////////////

    $('#submit').submit(function () {

        var num = $('input[name="num"]');
        var date = $('input[name="date"]').val();
        var datanum = num.val(); //這行抓到22



        /////用編號 或是 用日期+choose    
        if (datanum) {

            var StartID = globalStartID;
            var EndID = $('#EndID').val();
            var dest = 'search_num.php';

            getData(date, StartID, dest, chooseStaus, datanum, 'keyword');
        } else {

            var chooseStaus = $('input:radio:checked[name="R"]').val();

            console.log(chooseStaus);
            var StartID = globalStartID;
            var EndID = $('#EndID').val();
            var dest = 'search_date.php';

            getData(date, StartID, dest, chooseStaus, '', 'date');
            globalStartID += 10;
            if (EndID < globalStartID && EndID != 0) {
                //            <&!=0 more diseapear
                $('#more').fadeOut();
            }
        }

        return false;
    });




    /////////////////////
});