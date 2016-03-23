function getData(Y, M, D, StartId, dest, keyword, searchtype) {

    console.log(Y + M + D + StartId + dest + keyword + searchtype);

    $.ajax({
        url: dest,
        data: {

            'Date': Y + '-' + M + '-' + D,
            'keyword': keyword,
            'StartId': StartId,
        },
        type: "POST",
        dataType: 'html',


        success: function (response) {
            if (searchtype == 'date' || searchtype == 'keyword') {
                $('#more').remove();
            }
            $('#endID').remove();
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