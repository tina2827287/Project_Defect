<?php
	//連接資料庫（使用include方便維護）
	include("./mysql_connect.php");
	
	//取得各ajax欄位資料
	$num= $_POST["keyword"];

	
	//設定查詢語句與查詢-查詢日期
	$query = "SELECT * FROM productinfo WHERE pNum='$num'";
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
            echo "";
        }
        else {
					if($row["pState"])
					{
						echo "
                                <h3>
								<span class=\"ProductNum\">".$row["pNum"]."</span>
								<span class=\"Date\">".substr($row["pDate"] ,0 ,16)."</span>
								<span class=\"Def-Icon Defect\"><i class=\"fa fa-times-circle-o\"></i>Defect</span>
								</h3>
								<div>
								<a href=\"./img/".$row["pNum"].".bmp\" target=\"_blank\">
								<img src=\"./img/".$row["pNum"].".bmp\" alt=\"\">
								</a>
								</div>";
					} 
					else 
					{
						echo "
                                <h3 class=\"Well\">
								<span class=\"ProductNum\">".$row["pNum"]."</span>
								<span class=\"Date\">".substr($row["pDate"] ,0 ,16)."</span>
								<span class=\"Def-Icon Well\"><i class=\"fa fa-check-circle-o\"></i>Well</span>
								</h3>
								<div></div>
								";
					}
					
				//{$endID}可以直接把整數轉成字串
				echo "<input type=\"hidden\" id=\"EndID\" value=\"{$endID}\">";
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>