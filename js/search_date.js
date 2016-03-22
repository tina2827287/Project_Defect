function getData(Y, M, D, StartId, dest, keyword, searchtype) {

    $.ajax({
        url: dest,
        data: {

            'Year': Y,
            'Month': M,
            'Day': D,
            'keyword': keyword,
            'StartId': StartId,
            'searchtype': searchtype
        },
        type: "POST",
        dataType: 'html',


        success: function (response) {
            if (searchtype == 'date' || searchtype == 'keyword') {
                $('.accro').remove();

            }
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