var globalStartID = 0;
var getdate;

$(document).ready(function () {


    /////Default Action :觸發今天//////
    var d = new Date();
    var Year = d.getFullYear();
    var Mon = d.getMonth() + 1;
    if (Mon < 10)
        Mon = '0' + Mon;
    var Day = d.getDate();
    var Now = Year + '-' + Mon + '-' + Day;
    getdate = Now;

    $('#date').val(getdate);



    var StartID = globalStartID;
    var endID = $('#endID').val();
    var dest = 'search_date.php';

    //console.log(globalStartID, endID);

    getData(getdate, StartID, endID, dest, '', 'default');

    globalStartID += 10;
    if (globalStartID > 0) {
        endID = $('#endID').val();
        //  console.log(globalStartID, endID);
    }



    /////////////滑動效果/////////////////

    $('.accro').accordion({
        collapsible: true,
        active: false,
        animate: 200
    });

    //////////編號改變即送出////////////

    $('#num').keyup(function () {

        $('.accro').empty();

        var num = $('#num').val();
        console.log(num);

        var dest = 'search_num.php';
        getData('', '', '', dest, num, 'keyword');

    });


    /////////////選擇日期/////////////////
    $('#date').datepicker({
        dateFormat: 'yy-mm-dd',
        showAnim: 'slideDown',
        onSelect: function (dateText, inst) {
            getdate = dateText;

            globalStartID = 0;
            console.log(globalStartID, endID);
            var StartID = globalStartID;
            var endID = 0;
            console.log(endID, globalStartID);

            $('.accro').empty();
            $('#more').fadeIn();
            var dest = 'search_date.php';

            getData(getdate, StartID, endID, dest, '', 'default');
            globalStartID += 10;


        }
    });

    ////////已在查詢 按more看更多////////
    $('#more').click(function () {

        var Date = getdate;
        var StartID = globalStartID;
        var endID = $('#endID').val();
        var dest = 'search_date.php';
        console.log(globalStartID, endID);
        getData(Date, StartID, endID, dest, '', 'default');
        globalStartID += 10;

        if (globalStartID > 0) { // 按過more才可以抓到正確的endID否則endID會錯誤
            // endID = $('#endID').val();
            console.log(globalStartID, endID);

        }
    });

    //////////偵測開關開啟與否///////////
    $('#switch').click(function () {
        if ($('#switch').prop("checked")) {
            console.log('Checked');
            $('.Well').addClass('hide');
        } else {
            $('.Well').removeClass('hide');
        }

    });

    ////////如果點擊Top - 呼叫ScrollTo Plugin////////

    $('#scrollTop').click(function () {

        $.scrollTo('header', 400); //800 ms

    });

    /////////////////////////
});