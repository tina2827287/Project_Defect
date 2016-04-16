<?php
	include("./mysql_connect.php");
	//取得各ajax欄位資料
	$date = "2016-04-23";
    
    $start_day=substr($date ,8);
    $start_ym=substr($date ,0,8);
    $day7[8];
    $day7_total[8];
    $day7_def[8];
    for($i=0;$i<7;$i++)
    {
        $tmp=$start_day-$i;
        $day7[$i]=$start_ym.$tmp;
        
    //    echo $day7[$i].":  ";
    
        $query = "SELECT * FROM productinfo WHERE date(pDate)='$day7[$i]'";
        $query_def ="SELECT * FROM productinfo WHERE date(pDate)='$day7[$i]' AND pState=1";

        $result = mysqli_query($link, $query);
        $result_def = mysqli_query($link, $query_def);
        
        $day7_total[$i]=mysqli_num_rows($result);
        $day7_def[$i]=mysqli_num_rows($result_def);

        $day7_well[$i]=$day7_total[$i]-$day7_def[$i];
        
       // echo "(".$day7_total[$i]." , ".$day7_def[$i].")</br>";
        
    }
 

        
?>

    <!doctype html>

    <html>

    <head>
        <title>Result for
        </title>
        <meta charset="utf-8">
        <script type="text/javascript" src="./js/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['bar']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {
                var data = google.visualization.arrayToDataTable([
          ['Date', 'Total', 'Defect'],
            <?php
            
               for($i=6;$i>0;$i--){
                    echo "['".$day7[$i]."', ".$day7_total[$i].", ".$day7_def[$i]."],";
               }
                    echo "['".$day7[$i]."', ".$day7_total[$i].", ".$day7_def[$i]."]";
            
            ?>
        ]);

                var options = {
                    chart: {
                        title: 'Week Chart'
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, options);
            }
        </script>
    </head>

    <body style="text-align: center;">

        <div id="columnchart_material" style="width: 900px; height: 500px;"></div>

    </body>

    </html>