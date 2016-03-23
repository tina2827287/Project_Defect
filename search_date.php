<?php
	//連接資料庫（使用include方便維護）
	include("./mysql_connect.php");
	
	//取得各ajax欄位資料
    $startID = $_POST["StartId"];
	$date = $_POST["Date"];
	$chooseStaus=$_POST["chooseStaus"];
//echo "ChooseStaus=".$chooseStaus."</br>";
	$endID =0;
	//設定查詢語句與查詢-查詢日期

	/*if($chooseStaus=='defect'){
        
      //  echo "Def Choosed</br>";
		$query = "SELECT * FROM productinfo WHERE (date(pDate)='$date' AND pState=1) LIMIT $startID,10";
	}
    else if($chooseStaus=='all')
    {
      //  echo "All Choosed</br>";
		$query = "SELECT * FROM productinfo WHERE date(pDate)='$date' LIMIT $startID,10";
	}
	*/
$query = "SELECT * FROM productinfo WHERE date(pDate)='$date' LIMIT $startID,10";
$query_num = "SELECT COUNT(*) FROM productinfo WHERE date(pDate)='$date'";


	$result = mysqli_query($link, $query);

    $result_num = mysqli_query($link, $query_num);
    $rowcount=mysqli_num_rows($result_num);

if (!$result){
			//查詢失敗的錯誤處理	
      trigger_error('query failed', E_USER_ERROR);
        trigger_error('query_num failed', E_USER_ERROR);
    }
	else 
	{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if ( !$row ) {
						//資料庫為空的輸出處理
          //  echo '<p>尚無資料</p>';
        }
        else {
				
            do {
					if($row["pState"])
					{
						$icon = "Defect\"><i class=\"fa fa-times-circle-o\"></i>";
					} 
					else 
					{
						$icon = "Well\"><i class=\"fa fa-check-circle-o\"></i>";
					}
					echo "
                    <h3>
								<span class=\"ProductNum\">".$row["pNum"]."</span>
								<span class=\"Date\">".substr($row["pDate"] ,0 ,10)."</span>
								<span class=\"Def-Icon ".$icon."</span>
								</h3>
								<div>
								<a href=\"./img/".$row["pNum"].".bmp\" target=\"_blank\">
								<img src=\"./img/".$row["pNum"].".bmp\" alt=\"\">
								</a>
								</div>";
					//每輸出一項結果endID遞增
                $endID++;
					
            }
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC));
            
             $endID+=$startID;
            
				//{$endID}可以直接把整數轉成字串
				echo "<input type=\"hidden\" id=\"endID\" value=\"{$endID}\">";
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>