<?php
//連接資料庫（使用include方便維護）
include("./mysql_connect.php");
$date="2016-03-23";

$query = "SELECT * FROM productinfo WHERE date(pDate)='$date'";
$query_def ="SELECT * FROM productinfo WHERE date(pDate)='$date' AND pState=1";

$result = mysqli_query($link, $query);
$result_def = mysqli_query($link, $query_def);

$total=mysqli_num_rows($result);
$def=mysqli_num_rows($result_def);

echo "Total: ".$total."  Def:".$def;
?>