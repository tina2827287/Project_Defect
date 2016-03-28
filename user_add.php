<?php

//連接資料庫（使用include方便維護）
	include("./mysql_connect.php");

session_start();
if(!isset($_SESSION["if_login"])){

    echo '<meta http-equiv=REFRESH CONTENT=0;url="./login.html">';
    exit;
}


//////驗證是否管理者/////////

        //連接資料庫（使用include方便維護）
            include("./mysql_connect.php");

        //取得各ajax欄位資料
            $login_check= $_SESSION["if_login"];

            $query = "SELECT * FROM user WHERE user_id='$login_check'";

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

                if(!$row){
                    echo '<meta http-equiv=REFRESH CONTENT=0;url="./login.html">';
                    exit;
                }
                else{
                        if(!$row["user_mng"])
                        {
                            echo '<meta http-equiv=REFRESH CONTENT=0;url="./login.html">';
                            exit;
                        }

                }mysqli_free_result($result);  

            }mysqli_close($link);
///////////////////////
//連接資料庫（使用include方便維護）
	include("./mysql_connect.php");

$uname=$_POST["uname"];
$upw=$_POST["upw"];
$query = "SELECT * FROM user WHERE user_name='$uname'";
$result = mysqli_query($link, $query);
$rowsame = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($rowsame){
                //查詢失敗的錯誤處理	
                echo '<meta http-equiv=REFRESH CONTENT=0;url="./admin.php">';
                exit;
            }
            
            $query_ins = "INSERT INTO user (user_name,user_pw,user_mng) VALUES ('$uname','$upw','0')";
            $result_ins = mysqli_query($link, $query_ins);
 echo '<meta http-equiv=REFRESH CONTENT=0;url="./admin.php">';

        

mysqli_free_result($result_same); 
           
mysqli_close($link);

?>