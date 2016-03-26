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
                $('#more').remove();
            }
            $('input[type="hidden"]').remove();
            $('.accro').append(response);

            if ($('#switch').prop("checked")) {
                console.log('Checked');
                $('.Well').addClass('hide');
            } else {
                $('.Well').removeClass('hide');
            }

            $('.accro').accordion('refresh');

            //  console.log(response); //在主控台印出整個JSON



            endID = $('#endID').val();
            console.log(globalStartID, endID);
            if (endID < globalStartID && endID != 0) {
                console.log(globalStartID, endID);
                $('#more').fadeOut();
            } else {
                $('#more').fadeIn();
            }
        },

        error: function (xhr, ajaxOptions, thrownError) {
            alert(xhr.status);
            alert(thrownError);
        }


    });

}