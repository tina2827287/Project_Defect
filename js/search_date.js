function getData(Date, StartId, dest, chooseStaus, keyword, searchtype) {

    console.log(Y + M + D + StartId + dest + chooseStaus + keyword + searchtype);

    $.ajax({
        url: dest,
        data: {

            'Date': Date,
            'keyword': keyword,
            'StartId': StartId,
            'chooseStaus': chooseStaus
        },
        type: "POST",
        dataType: 'html',


        success: function (response) {
            if (searchtype == 'date' || searchtype == 'keyword') {
                $('#more').remove();
            }
            $('input[type="hidden"]').remove();
            $('.accro').append(response);
            $('.accro').accordion('refresh');

            console.log(response); //在主控台印出整個JSON
        },

        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }


    });

}