$(document).ready(function () {

    $('#pnumForm').submit(function () {

        var num = $('#pnum').val();
        if (isNaN(num)) {
            alert('產品號為數字組成，僅可輸入數字');
            return false;
        }
        if (num == '') {
            alert('產品號不得為空');
            return false;
        }



    });

    $('#userForm').submit(function () {

        var uname = $('#uname').val();
        var upw = $('#upw').val();
        var re = /^[a-zA-Z0-9]+$/;

        if (uname == '' || upw == '') {
            alert('帳號密碼不得為空');
            return false;
        }
        if (uname.length > 16) {
            alert('帳號命名長度錯誤!(最大長度:16)');
            return false;
        }
        if (upw.length > 20) {
            alert('密碼設定長度錯誤!(最大長度:20)')
            return false;
        }

        if (!re.test(uname) || !re.test(upw)) {
            alert('帳號密碼不可含有特殊字元');
            return false;

        }



    });

});