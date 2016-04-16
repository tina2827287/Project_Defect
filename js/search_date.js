function getData(Date, StartId, endID, dest, keyword, searchtype) {

    console.log(Date + StartId + dest + keyword + searchtype);

    $.ajax({
        url: dest,
        data: {
            'Date': Date,
            'keyword': keyword,
            'StartId': StartId,
            'endID': endID,
        },
        type: "POST",
        dataType: 'html',


        success: function (response) {
            if (searchtype == 'keyword') {
                $('#more').fadeOut();
            }
            $('input#endID').remove();
            $('.accro').append(response);

            if ($('#switch').prop("checked")) {
                console.log('Checked');
                $('.Well').addClass('hide');
            } else {
                $('.Well').removeClass('hide');
            }

            $('.accro').accordion('refresh');

            console.log(response); //在主控台印出整個JSON

            endID = $('#endID').val();
            console.log(globalStartID, endID);
            if (endID < globalStartID && endID != 0 || endID == -1) {
                console.log(globalStartID, endID);
                $('#more').fadeOut();
            } else {

                console.log('fadeIn');
                var m = $('#more');
                console.log(m);
                m.css('display', 'block');

            }
        },

        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }


    });

}