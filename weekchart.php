<?php
	include("./mysql_connect.php");
	//取得各ajax欄位資料
	$date=$_POST["chartd"];
    
    $start_day=substr($date ,8);
    $start_month=substr($date ,5,2);
    $start_year=substr($date ,0,4);
    
    $day7[8];
    $day7_total[8];
    $day7_def[8];

    if($start_day<7){
             
           //  echo "now_month: ".$start_month."</br>";
                $bef_month=$start_month-1;
                if($bef_month<10)//<10的要串接0
                    $bef_month='0'.$bef_month;
              //  echo "bef_month: ".$bef_month."</br>";
                    $days=date("t",strtotime($start_year.'-'.$bef_month.'-'.'01'));
              //  echo "Bef_month-days: ".$days."</br>";
        //     
         for($i=0;$i<7;$i++){
             $tmp=$start_day-$i;
             
             if($tmp<10 && $tmp>0)//運算完 <10者要補0
                 $tmp='0'.$tmp;
             
             if($tmp<1){
                    $tmp=$days;
                    $days--;
                    $day7[$i]=$start_year.'-'.$bef_month.'-'.$tmp;
            }
             else{
                  $day7[$i]=$start_year.'-'.$start_month.'-'.$tmp;
             } 
                   
            // echo "day7: ". $day7[$i]."</br>";

                    $query = "SELECT * FROM productinfo WHERE date(pDate)='$day7[$i]'";
                    $query_def ="SELECT * FROM productinfo WHERE date(pDate)='$day7[$i]' AND pState=1";

                    $result = mysqli_query($link, $query);
                    $result_def = mysqli_query($link, $query_def);

                    $day7_total[$i]=mysqli_num_rows($result);
                    $day7_def[$i]=mysqli_num_rows($result_def);

                    $day7_well[$i]=$day7_total[$i]-$day7_def[$i];
            }
        
            
        }
        
        else{
                for($i=0;$i<7;$i++){

                    $tmp=$start_day-$i;
                    $day7[$i]=$start_year.'-'.$start_month.'-'.$tmp;

                //    echo $day7[$i].":  ";

                    $query = "SELECT * FROM productinfo WHERE date(pDate)='$day7[$i]'";
                    $query_def ="SELECT * FROM productinfo WHERE date(pDate)='$day7[$i]' AND pState=1";

                    $result = mysqli_query($link, $query);
                    $result_def = mysqli_query($link, $query_def);

                    $day7_total[$i]=mysqli_num_rows($result);
                    $day7_def[$i]=mysqli_num_rows($result_def);

                    $day7_well[$i]=$day7_total[$i]-$day7_def[$i];
                }
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
          ['日期', '當日生產總量', '當日瑕疵個數'],
            <?php
            
               for($i=6;$i>0;$i--){
                    echo "['".$day7[$i]."', ".$day7_total[$i].", ".$day7_def[$i]."],";
               }
                    echo "['".$day7[$i]."', ".$day7_total[$i].", ".$day7_def[$i]."]";
            
            ?>
        ]);

                var options = {
                    chart: {
                        title: '當周瑕疵率統計圖'
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