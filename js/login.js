$(document).ready(function () {


    $('form').submit(function () {

        var pw = $('#password').val();
        var user = $('#user').val();

        if (user == '' || pw == '') {
            alert('帳號密碼不得為空!!!');
            return false;
        }

    });


});