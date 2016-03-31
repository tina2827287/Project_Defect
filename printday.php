<?php
//連接資料庫（使用include方便維護）
	include("./mysql_connect.php");
?>
    <!doctype html>
    <html>

    <head>
        <title>Result for
            <?php echo $_POST["printd"];?>
        </title>
        <meta charset="utf-8">
        <style>
            .pure-table {
                border-collapse: collapse;
                border-spacing: 0;
                empty-cells: show;
                border: 1px solid #cbcbcb
            }
            
            .pure-table caption {
                color: #000;
                font: italic 85%/1 arial, sans-serif;
                padding: 1em 0;
                text-align: center;
            }
            
            .pure-table td,
            .pure-table th {
                border-left: 1px solid #cbcbcb;
                border-width: 0 0 0 1px;
                font-size: inherit;
                margin: 0;
                overflow: visible;
                padding: .5em 1em
            }
            
            .pure-table td:first-child,
            .pure-table th:first-child {
                border-left-width: 0;
            }
            
            .pure-table thead {
                background-color: #e0e0e0;
                color: #000;
                text-align: left;
                vertical-align: bottom;
            }
            
            .pure-table td {
                background-color: transparent
            }
            
            .pure-table-striped tr:nth-child(2n-1) td {
                background-color: #f2f2f2
            }
        </style>
    </head>

    <body style="text-align: center;">

        <h3>Result for <?php echo $_POST["printd"];?></h3>
        <table style="width: 100%;" class="pure-table pure-table-striped">

            <thead>

                <tr style="border-bottom: 1px solid #eee;">

                    <th style="text-align: center;">Serial Number</th>

                    <th style="text-align: center;">Date</th>

                    <th style="text-align: center;">Status</th>
                </tr>
            </thead>

            <tbody>
                <?php
      
	$date = $_POST["printd"];

    $query = "SELECT * FROM productinfo WHERE date(pDate)='$date'";
	$result = mysqli_query($link, $query);


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
                     if($row["pState"]){								
                         echo "<tr style=\"border-bottom: 1px solid #eee;\">
                                 <td>".$row["pNum"]."</td>
                                 <td>".substr($row["pDate"] ,0 ,16)."</td>
                                 <td>Defect</td>
                             </tr>";
                     } else {							
                         echo "<tr style=\"border-bottom: 1px solid #eee;\">
                                 <td>".$row["pNum"]."</td>
                                 <td>".substr($row["pDate"] ,0 ,16)."</td>
                                 <td>OK</td>
                             </tr>";
                     }
             } while($row = mysqli_fetch_array($result, MYSQLI_ASSOC));
         }
         mysqli_free_result($result);
     }
     mysqli_close($link);
            
 ?>
            </tbody>
        </table>
    </body>
    <script>
        (function () {
            window.print();
        })();
    </script>

    </html>