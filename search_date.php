<?php
	//連接資料庫（使用include方便維護）
	include("./mysql_connect.php");
	
	//取得各ajax欄位資料
    $startID = $_POST["StartId"];
    $endID=$_POST["endID"];
	$date = $_POST["Date"];
	$chooseStaus=$_POST["chooseStaus"];

$query = "SELECT * FROM productinfo WHERE date(pDate)='$date' LIMIT $startID,10";


	$result = mysqli_query($link, $query);

 //   $result_num = mysqli_query($link, $query_num);
//    $rowcount=mysqli_num_rows($result_num);

if (!$result){
			//查詢失敗的錯誤處理	
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
					if($row["pState"])//劣品
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
					else //良品
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