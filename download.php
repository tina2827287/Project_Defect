<?php
include("./mysql_connect.php");

$query_Pro="SELECT * FROM program";
$result = mysqli_query($link, $query_Pro);

$ProName[50];$ProBef[50];$ProAft[50];$ProCont[50];$ProSHA[50];
$ProNum=0;
$dlurl='phpdl.php';
    if (!$result){
      trigger_error('query failed', E_USER_ERROR);
    }
	else 
	{
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            do {
					$ProNum++;
                    $ProName[$ProNum]=$row["ProgramName"];
                    $ProBef[$ProNum]=$row["ProgramBef"];
                    $ProAft[$ProNum]=$row["ProgramAft"];
                    $ProCont[$ProNum]=$row["ProgramContent"];
                    $ProSHA[$ProNum]=$row["SHA"];
            }while($row = mysqli_fetch_array($result, MYSQLI_ASSOC));
        
    }mysqli_free_result($result);
?>


    <!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <title>瑕疵系統-下載專區</title>

        <link rel="stylesheet" href="./css/pure-min.css">
        <link rel="stylesheet" href="./css/dl.css">
        <link rel="stylesheet" href="./css/font-awesome-4.5.0/css/font-awesome.min.css">
    </head>

    <body>


        <header>
            <h1>下載專區</h1>
            <h2>此區提供各檢測程式下載</h2>
        </header>
        <div class="wrapper">

            <div class="tag">
                <?php 
                    for($n=1;$n<=$ProNum;$n++){
                        echo
                            "<a href=\"#p".$n."\">".$ProName[$n]."</a>";
                    }    
                ?>
            </div>

            <table class="pure-table">
                <thead>
                    <tr>
                        <th>程式名稱</th>
                        <th>Before </th>
                        <th>After</th>
                        <th>功能說明</th>
                        <th>下載檔案</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                        for($n=1;$n<=$ProNum;$n++){
                        echo "<tr>".
                                "<td id=\"p".$n."\">".$ProName[$n]."</td>".
                                "<td>
                                   <div><img src=\"".$ProBef[$n]."\"></div>
                                </td>".
                                "<td>
                                    <div><img src=\"".$ProAft[$n]." \"></div>
                                </td>".
                                "<td>".$ProCont[$n]."</td>".
                            "<td>"."<a href=\"phpdl.php?SHA=".$ProSHA[$n]."\"><i class=\"fa fa-download\" aria-hidden=\"true\"></i></a>".
                           "</td>".
                            "</tr>";
                        }                        
                    ?>
                </tbody>
            </table>
        </div>
        <footer>

            <p>
                <a href="login.php?logout=1">登出</a> Copyright 2016 Ting-Yu Wang
                <a id="scrollTop">Top</a>
            </p>

        </footer>
    </body>
    <script src="./js/jquery-2.2.2.min.js"></script>
    <script src="./js/jquery-ui.min.js"></script>
    <script src="./js/jquery.scrollTo-min.js"></script>
    <script src="./js/search_date.js"></script>
    <script src="./js/index.js"></script>
    <?php     mysqli_close($link);?>

    </html>