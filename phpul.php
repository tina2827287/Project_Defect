<?php
    include("./mysql_connect.php");

    $ProName=$_POST["fName"];
    $ProContent=$_POST["fileContent"];

    $BefImg=$_FILES["BefImg"];
    $AftImg=$_FILES["AftImg"];
    $ProFile=$FILES["ProFile"];

    $ImgPath='./dlzip/BAimg/';
    $ProPath='./dlzip/';

    $FileSHA=md5(uniqid(rand()));

    echo "檔案名稱: ".$_FILES["BefImg"]["name"]."<br>";
    echo "檔案類型: ".$_FILES["BefImg"]["type"]."<br>";
    echo "檔案大小: ".$_FILES["BefImg"]["size"]."<br>";
    echo "暫存名稱: ".$_FILES["BefImg"]["tmp_name"]."<br>";

    $BefPath=$ImgPath.$_FILES["BefImg"]["name"];
echo $BefPath.'<br>';
    move_uploaded_file($_FILES["BefImg"]["tmp_name"] ,$BefPath);
    echo "<br>";
    
    echo "檔案名稱: ".$_FILES["AftImg"]["name"]."<br>";
    echo "檔案類型: ".$_FILES["AftImg"]["type"]."<br>";
    echo "檔案大小: ".$_FILES["AftImg"]["size"]."<br>";
    echo "暫存名稱: ".$_FILES["AftImg"]["tmp_name"]."<br>";
    $AftPath=$ImgPath.$_FILES["AftImg"]["name"];
echo $AftPath.'<br>';
    move_uploaded_file($_FILES["AftImg"]["tmp_name"] , $AftPath);
    echo "<br>";
    
    echo "檔案名稱: ".$_FILES["ProFile"]["name"]."<br>";
    echo "檔案類型: ".$_FILES["ProFile"]["type"]."<br>";
    echo "檔案大小: ".$_FILES["ProFile"]["size"]."<br>";
    echo "暫存名稱: ".$_FILES["ProFile"]["tmp_name"]."<br>";
    $ProPath=$ProPath.$_FILES["ProFile"]["name"];
echo $ProPath.'<br>';
    move_uploaded_file($_FILES["ProFile"]["tmp_name"] ,$ProPath);

    $query_ins = "INSERT INTO program (ProgramName,ProgramBef,ProgramAft,ProgramContent,SHA) VALUES ('$ProName','$BefPath','$AftPath','$ProContent','$FileSHA')";
    $result_ins = mysqli_query($link, $query_ins);
 



?>