var globalStartID = 0;
var number = $('input[name="number"]');
var chooseStaus = 'all';
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
    console.log(Now);
    getdate = Now;
    var StartID = globalStartID;
    var endID = $('#endID').val();
    var dest = 'search_date.php';
    getData(Now, StartID, dest, chooseStaus, '', 'default');
    globalStartID += 10;

    endID = $('#endID').val();
    console.log(endID);
    if (endID < globalStartID && endID != 0) {
        $('#more').fadeOut();
    }

    /////////////滑動效果/////////////////

    $('.accro').accordion({
        collapsible: true,
        active: false,
        animate: 200
    });

    /////////////選擇日期/////////////////
    $('#date').datepicker({
        dateFormat: 'yy-mm-dd',
        showAnim: 'slideDown',
        onSelect: function (dateText, inst) {
            getdate = dateText;
            //console.log(getdate);
            var StartID = globalStartID;
            var endID = $('#endID').val();
            var dest = 'search_date.php';

            /*      $('input:checkbox:checked[name="sw_def"]').click(function () {
                chooseStaus = 'defect';
            });
*/
            getData(getdate, StartID, dest, chooseStaus, '', 'date');

        }
    });
    ////////已在查詢 按more看更多////////
    $('#more').click(function () {

        var Date = getdate;
        var StartID = globalStartID;
        var endID = $('#endID').val();
        var dest = 'search_date.php';

        getData(Date, StartID, dest, chooseStaus, '', 'default');
        globalStartID += 10;
        console.log(globalStartID);
        console.log(endID);
        if ((endID % 10 != 0)) {
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
            alert(請輸入產品號);
        }

        return false;
    });
    /////////////////////




});