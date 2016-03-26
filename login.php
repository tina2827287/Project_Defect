<?php

    //啟動Session
    session_start();
//驗證登出
if($_GET["logout"]){
    unset($_SESSION["if_login"]);
        echo '<meta http-equiv=REFRESH CONTENT=0;url="./login.html">';
    exit;
}

    //連接資料庫（使用include方便維護）
	include("./mysql_connect.php");
	
	//取得各ajax欄位資料
	$uname= $_POST["user"];
    $upw= $_POST["password"];


    //設定查詢語句與查詢-查詢日期
	$query = "SELECT * FROM user WHERE user_name='$uname'";
	$result = mysqli_query($link, $query);

	if (!$result){
        //查詢失敗的錯誤處理	
                        echo '<meta http-equiv=REFRESH CONTENT=0;url="./login.html">';
        exit;
        trigger_error('query failed', E_USER_ERROR);
    }
	else 
	{ 
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

           if(!$row)
           {
                        echo '<meta http-equiv=REFRESH CONTENT=0;url="./login.html">';
               exit;
           }
            else
            {
                    if($row["user_pw"]==$upw)
                    {
                        $_SESSION["if_login"]=$row["user_id"];
                         echo '<meta http-equiv=REFRESH CONTENT=0;url="/">';
                        exit;
                    }
            } 
        mysqli_free_result($result);  
    }
    mysqli_close($link);
 
                        echo '<meta http-equiv=REFRESH CONTENT=0;url="./login.html">';

?>