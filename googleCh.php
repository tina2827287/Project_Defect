<?php
//連接資料庫（使用include方便維護）
	include("./mysql_connect.php");
$date=$_POST["chartd"];

$query = "SELECT * FROM productinfo WHERE date(pDate)='$date'";
$result = mysqli_query($link, $query);

$total_cnt=0;
$def_cnt=0;

if (!$result){
 			//查詢失敗的錯誤處理	
       trigger_error('query failed', E_USER_ERROR);
     } else {
         $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
         if ( !$row ) {
 						//資料庫為空的輸出處理
             echo "";
         }
         else {
             do {
                 $total_cnt++;
                     if($row["pState"]){								
                         $def_cnt++;
                     } 
                 
             } while($row = mysqli_fetch_array($result, MYSQLI_ASSOC));
         }
         mysqli_free_result($result);
     }
     mysqli_close($link);
     
$well_cnt=$total_cnt-$def_cnt;

//echo "Well=".$well_cnt;
//echo " Def=".$def_cnt;
 ?>

    <html>

    <head>
        <title>
            <?php echo $date."統計圖表";?>
        </title>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
          ['Product', 'Staus per product'],
        ['Well', <?php echo $well_cnt;?>],
          ['Defect', <?php echo $def_cnt;?>]

        ]);

                var options = {
                    title: '<?php echo $date." 瑕疵率";?>'
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
        </script>
    </head>

    <body style="text-align: center;">
        <div id="piechart" style="width: 900px; height: 500px; text-align: center;"></div>
    </body>

    </html>