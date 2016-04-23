<?php
	include("./mysql_connect.php");
	$date=$_POST["chartd"];//抓取今日日期  舉例:2015-04-21
    
    // 做字串串接部分
    $start_day=substr($date ,8);//起始日:21
    $start_month=substr($date ,5,2);//起始月:4
    $start_year=substr($date ,0,4);//起始年:2015
    
    $day7[8];//存放 哪7個日期
    $day7_total[8];//存放 日期i對應的總量
    $day7_well[8];//存放 日期i對應的良品量
    $day7_def[8];//存放 日期i對應的裂品量

    //起始日<7 需要銜接上個月 去找上個月的天數(30或31)
    if($start_day<7){
             
            //上個月=這個月-1 如果是12月->1月
                $bef_month=$start_month-1;
                if($start_month==12)
                    $bef_month=1;
                //<10的要串接0
                if($bef_month<10)
                    $bef_month='0'.$bef_month;
            //php語法:得到上個月總天數幾天(30或31)
                $days=date("t",strtotime($start_year.'-'.$bef_month.'-'.'01'));
                   
         for($i=0;$i<7;$i++){
             //假設起始日是5: tmp=(5-0) (5-1) (5-2)....
             $tmp=$start_day-$i;
             
             //5->05
             if($tmp<10 && $tmp>0)//運算完 <10者要補0
                 $tmp='0'.$tmp;
             
             //日期tmp=5-6=-1 時 從4月的30日開始算回去
             if($tmp<1){
                    $tmp=$days;//tmp=30 29 28....
                    $days--;
                    $day7[$i]=$start_year.'-'.$bef_month.'-'.$tmp;//字串串接: 2015-04-30
             }
             //日期>=1的情況
             else{
                  $day7[$i]=$start_year.'-'.$start_month.'-'.$tmp;
             } 
                   
            // 資料庫查詢總量、瑕疵品

                    $query = "SELECT * FROM productinfo WHERE date(pDate)='$day7[$i]'";
                    $query_def ="SELECT * FROM productinfo WHERE date(pDate)='$day7[$i]' AND pState=1";

                    $result = mysqli_query($link, $query);
                    $result_def = mysqli_query($link, $query_def);

                    $day7_total[$i]=mysqli_num_rows($result);
                    $day7_def[$i]=mysqli_num_rows($result_def);

                    $day7_well[$i]=$day7_total[$i]-$day7_def[$i];
            }
        
            
        }
        //起始日>7 正常加減日期做查詢
        else{
                for($i=0;$i<7;$i++){

                    $tmp=$start_day-$i;
                    $day7[$i]=$start_year.'-'.$start_month.'-'.$tmp;

            // 資料庫查詢總量、瑕疵品
                    $query = "SELECT * FROM productinfo WHERE date(pDate)='$day7[$i]'";
                    $query_def ="SELECT * FROM productinfo WHERE date(pDate)='$day7[$i]' AND pState=1";

                    $result = mysqli_query($link, $query);
                    $result_def = mysqli_query($link, $query_def);

                    $day7_total[$i]=mysqli_num_rows($result);
                    $day7_def[$i]=mysqli_num_rows($result_def);

                    $day7_well[$i]=$day7_total[$i]-$day7_def[$i];
                }
        
    }
 
//下面html內的這段請刪除(列印功能)
/*
                google.visualization.events.addListener(chart, 'ready', function () {
                    window.print();
                });

*/
        
?>

    <!doctype html>

    <html>

    <head>
        <title>
            <?php echo substr($day7[6] ,5,5)." ~ ".substr($day7[0] ,5,5)."一周統計圖表" ?>
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
          ['日期', '當日生產總量', '當日良品個數'],
            <?php
            
               for($i=6;$i>0;$i--){
                    echo "['".$day7[$i]."', ".$day7_total[$i].", ".$day7_well[$i]."],";
               }
                    echo "['".$day7[$i]."', ".$day7_total[$i].", ".$day7_well[$i]."]";
            
            ?>
        ]);

                var options = {
                    chart: {
                        title: '當周瑕疵率統計圖'
                    }
                };

                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                chart.draw(data, options);
                google.visualization.events.addListener(chart, 'ready', function () {
                    window.print();
                });

            }
        </script>
    </head>

    <body style="text-align: center;">

        <div id="columnchart_material" style="width: 900px; height: 500px; text-alig:center;"></div>

    </body>



    </html>