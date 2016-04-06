<?php
//連接資料庫（使用include方便維護）
include("./mysql_connect.php");
$date=$_POST["chartd"];

$query = "SELECT * FROM productinfo WHERE date(pDate)='$date'";
$query_def ="SELECT * FROM productinfo WHERE date(pDate)='$date' AND pState=1";

$result = mysqli_query($link, $query);
$result_def = mysqli_query($link, $query_def);

$total=mysqli_num_rows($result);
$def=mysqli_num_rows($result_def);

$well=$total-$def;


 ?>

    <html>

    <head>
        <title>
            <?php echo $date."統計圖表";?>
        </title>
        <script type="text/javascript" src="./js/loader.js"></script>
        <script type="text/javascript">
            google.charts.load('current', {
                'packages': ['corechart']
            });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = google.visualization.arrayToDataTable([
                      ['Product', 'Staus per product'],
                      ['Well', <?php echo $well;?>],
                      ['Defect', <?php echo $def;?>]
                ]);

                var options = {
                    title: '<?php echo $date." 瑕疵率";?>',
                };

                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                chart.draw(data, options);
            }
        </script>
    </head>

    <body style="text-align: center;">
        <div id="piechart" style="width: 900px; height: 300px; text-align: center; font-size:1.5em;">
        </div>
    </body>

    </html>