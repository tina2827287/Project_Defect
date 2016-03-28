<?php 

session_start();
if(!isset($_SESSION["if_login"])){
    echo '<meta http-equiv=REFRESH CONTENT=0;url="./login.html">';
    exit;
}
?>



    <!doctype html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>瑕疵查詢</title>
        <link rel="stylesheet" href="./css/pure-min.css">
        <link rel="stylesheet" href="./css/frame.css">
        <link rel="stylesheet" href="./css/font-awesome-4.5.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="./css/datepicker.css">
    </head>

    <body>
        <header>
            <h1>Defect Search</h1>
        </header>
        <nav id="#top-bar">
            <form>
                <div class="search-div">
                    <h3>日期查詢</h3>
                    <input name="date" type="text" id="date" placeholder="選擇日期">
                </div>
                <div class="search-div">
                    <h3>編號查詢</h3>
                    <input id="num" type="text" placeholder="輸入產品編碼" autocomplete="off">
                </div>


                <div class="search-div">
                    <h3>Staus</h3>All
                    <div id="sw-frame">
                        <input type="checkbox" id="switch" name="sw_def">
                        <label for="switch">
                            <div id="sw-div">
                            </div>
                        </label>
                    </div> Defect
                </div>
            </form>
        </nav>
        <div class="wrapper">
            <ul id="content">
                <p>Defect Searching Results</p>
                <li id="content-head">
                    <span>編號</span>
                    <span>日期</span>
                    <span>Status</span>
                </li>
                <li class="accro">
                    <input name="endID" id="endID" value="0" type="hidden">
                </li>
                <div id="more">
                    <h3>more</h3></div>
            </ul>
            <footer>

                <p>
                    <a href="login.php?logout=1">登出</a> Copyright 2016 Ting-Yu Wang
                    <a id="scrollTop">Top</a>
                </p>

            </footer>
        </div>


    </body>
    <script src="./js/jquery-2.2.2.min.js"></script>
    <script src="./js/jquery-ui.min.js"></script>
    <script src="./js/jquery.scrollTo-min.js"></script>
    <script src="./js/search_date.js"></script>
    <script src="./js/index.js"></script>


    </html>