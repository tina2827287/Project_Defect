<?php 

session_start();
if(!isset($_SESSION["if_login"])){

    echo '<meta http-equiv=REFRESH CONTENT=0;url="./login.html">';
    exit;
}


    /////////驗證是否管理者///////////

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

?>
    <!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>瑕疵查詢</title>
        <link rel="stylesheet" href="./css/pure-min.css">
        <link rel="stylesheet" href="./css/frame.css">
        <link rel="stylesheet" href="./css/admin.css">
        <link rel="stylesheet" href="./css/font-awesome-4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/datepicker.css">
    </head>

    <body>
        <header>
            <h1>Defect Search Admin</h1>
        </header>
        <div class="wrapper">
            <ul id="content">
                <li id="content-error">
                    <form action="./user_chg.php" method="post">
                        <h3>
                        <span class="err-pNum"><input type="text" name="pnum" placeholder="Add ProductNum"></span>
                        <span class="err-update"><button class="mybtn chg-btn">Change <i class="fa fa-pencil"></i></button></span>
                    </h3>
                    </form>
                </li>
                <li id="content-head">
                    <span>User-Account</span>
                    <span>User-Password</span>
                    <span>Option</span>
                </li>
                <li class="content-li">
                    <form action="./user_add.php" method="post">
                        <h3>
                        <span class="user-name" ><input  name="uname" type="text" placeholder="Add Username"></span>
                        <span class="user-passwd"><input   name="upw" type="text" placeholder="Add Password"></span>
                        <span class="user-add"><button class="mybtn add-btn" type="submit">Add <i class="fa fa-plus-square"></i></button></span>
                    </h3>
                    </form>
                    <h3>
                        <span>account</span>
                        <span>paddword</span>
                        <span class="user-del"><button class="mybtn del-btn">Delete<i class="fa fa-trash"></i></button></span> 
                    </h3>
                    <h3>
                        <span>account</span>
                        <span>paddword</span>
                        <span class="user-del"><button class="mybtn del-btn">Delete<i class="fa fa-trash"></i></button></span> 
                    </h3>

                    <?php	
                    //連接資料庫（使用include方便維護）
	include("./mysql_connect.php");
                    
                        $query = "SELECT * FROM user WHERE user_mng=0";
	                    $result = mysqli_query($link, $query);
                    
        if (!$result){
			//查詢失敗的錯誤處理	
            echo "Error!";
      trigger_error('query failed', E_USER_ERROR);
    }
	else 
	{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ( !$row ) {
            //資料庫為空的輸出處理
            echo '<p>無資料</p>';
        }
        else {
				
            do {
					
                            echo "
                                <h3>
								<span>".$row["user_name"]."</span>
                                <span>".$row["user_pw"]."</span>
								<span class=\"user-del\"><a class=\"mybtn del-btn\" href=\"user_del.php?id=".$row["user_id"]."\">Delete<i class=\"fa fa-trash\"></i></a></span>
								</h3>";
                    
            }while($row = mysqli_fetch_array($result, MYSQLI_ASSOC));
        }mysqli_free_result($result);
    }mysqli_close($link);
                    
                    ?>


                </li>

            </ul>
            <footer>

                <p>
                    <a href="login.php?logout=1">登出</a> Copyright 2016 Ting-Yu Wang
                    <a id="scrollTop">Top</a>
                </p>

            </footer>
        </div>


    </body>
    <script src="./js/jquery-2.2.2.min.js"></script>
    <script src="./js/jquery-ui.min.js"></script>
    <script src="./js/jquery.scrollTo-min.js"></script>
    <script src="./js/search_date.js"></script>
    <script src="./js/admin.js"></script>
    <script src="./js/index.js"></script>


    </html>