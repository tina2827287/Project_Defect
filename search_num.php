<?php
	//連接資料庫（使用include方便維護）
	include("./mysql_connect.php");
	
	//取得各ajax欄位資料
	$num= $_POST["keyword"];

	
	//設定查詢語句與查詢-查詢日期
	$query = "SELECT * FROM productinfo WHERE pNum=$num ";
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
            echo '<p>無此產品</p>';
        }
        else {
				//設定endID
					$endID = 0;
            do {
					if($row["pState"])
					{
						$icon = "defect\"><i class=\"fa fa-times-circle-o\"></i>Defect";
					} 
					else 
					{
						$icon = "ok\"><i class=\"fa fa-check-circle-o\"></i>OK";
					}
					echo "<h3>
								<span class=\"ProductNum\">".$row["pNum"]."</span>
								<span class=\"Date\">".substr($row["pDate"] ,0 ,10)."</span>
								<span class=\"Def-Icon ".$icon."</span>
								</h3>
								<div>
								<a href=\"./img/".$row["pNum"].".bmp\" target=\"_blank\">
								<img src=\"./img/".$row["pNum"].".bmp\" alt=\"\"></a>
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