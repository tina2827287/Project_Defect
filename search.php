<?php
	//連接資料庫（使用include方便維護）
	include("./mysql_connect.php");
	
	//取得各ajax欄位資料
	$date = $_POST["Date"];
	$startID = $_POST["startID"];
	
	//設定查詢語句與查詢
	$query = "SELECT * FROM product WHERE date(p_date)='$date'";
	$result = mysqli_query($link, $query);

	if (!$result){
			//查詢失敗的錯誤處理	
      trigger_error('query failed', E_USER_ERROR);
    }
	else 
	{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ( !$row ) {
						//資料庫為空的輸出處理
            echo '<p>尚無資料</p>';
        }
        else {
				//設定endID
					$endID = 0;
            do {
					if($row["p_status"]){
						$icon = "defect\"><i class=\"fa fa-times-circle-o\"></i>Defect";
					} else {
						$icon = "ok\"><i class=\"fa fa-check-circle-o\"></i>OK";
					}
					echo "<h3>
								<span class=\"ProductNum\">".$row["p_num"]."</span>
								<span class=\"Date\">".substr($row["p_date"] ,0 ,10)."</span>
								<span class=\"Def-Icon ".$icon."</span>
								</h3>
								<div>
								<a href=\"".$row["p_pic"]."\" target=\"_blank\">
								<img src=\"".$row["p_pic"]."\" alt=\"\">
								</a>
								</div>";
					//每輸出一項結果endID遞增
					$endID++;
            }
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC));
				//{$endID}可以直接把整數轉成字串
				echo "<input type=\"hidden\" id=\"endID\" value=\"{$endID}\">";
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>