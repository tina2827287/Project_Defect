<!doctype html>
<html>

<head>

</head>

<body>
    <?php
	//連接資料庫（使用include方便維護）
	include("./mysql_connect.php");
	
	$date = $_POST["printaaa"];
    echo $date."產品資料";

    $query = "SELECT * FROM productinfo WHERE date(pDate)='$date'";
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
								</h3>";
                    
                    } 
					else //良品
					{

    					echo "
                                <h3 class=\"Well\">
								<span class=\"ProductNum\">".$row["pNum"]."</span>
								<span class=\"Date\">".substr($row["pDate"] ,0 ,16)."</span>
								<span class=\"Def-Icon Well\"><i class=\"fa fa-check-circle-o\"></i>Well</span>
								</h3>";
                        
                    }
					
            }
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC));
        }
        mysqli_free_result($result);
    }
    mysqli_close($link);
?>
</body>

</html>