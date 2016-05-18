<?php
	//連接資料庫（使用include方便維護）
	include("./mysql_connect.php");
	
	//取得各ajax欄位資料

	$date = $_POST["Date"];

    $query = "SELECT * FROM productinfo WHERE date(pDate)='$date'";
    $result = mysqli_query($link, $query);
    $total=mysqli_num_rows($result);

    echo "  :  ".$total;

    mysqli_free_result($result);
    
    mysqli_close($link);
?>