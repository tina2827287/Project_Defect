function getTotal(Date, dest) {
    console.log(Date + dest);

    $.ajax({
        url: dest,
        data: {
            'Date': Date,
        },
        type: "POST",
        dataType: 'html',


        success: function (response) {
            todayTotal.innerHTML = "今日總產量 " + response;
            $('#todayTotal').removeClass('toolform');
            console.log(response); //在主控台印出整個JSON

        },

        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }


    });

}