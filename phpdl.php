<?php
include("./mysql_connect.php");
$FileSHA = $_GET["SHA"];
echo "SHA: ".$FileSHA."<br>";
    $query = "SELECT * FROM program WHERE SHA = '$FileSHA'";
    $result = mysqli_query($link, $query);

    if (!$result){
      trigger_error('query failed', E_USER_ERROR);
    } 
    else {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        
        $file_name = $row["ProgramFileName"];
        $file_path = "./dlzip/".$file_name;
        $file_size = filesize($file_path.$file_name);
        
        echo "FileName".$file_name."<br>";
        echo "FilePath".$file_path."<br>";
        $l=strlen($file_name);
        $file_type=substr($file_name,$l-3,3);
        echo "File type".$file_type."<br>";
        
       
header("Pragma: public");
header("Expires: 0");
header('Last-Modified: ' . gmdate('D, d M Y H:i ') . ' GMT');
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private', false");
header("Content-Description: File Transfer");
header("Content-type: application/".$file_type);
//header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"".$file_name."\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: ".filesize($file_path));
ob_end_flush();
@readfile($file_path.$file_name);

        
    }

 echo '<meta http-equiv=REFRESH CONTENT=0;url="./download.html">';


?>