<?php
$file_name = "01.zip";
$file_path = "./dlzip/";
$file_size = filesize($file_path.$file_name);
$file_type=substr($file_name,(strlen($file_name)-3),3);
//echo $file_type;
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
header("Content-Length: ".filesize($file_path.$file_name));
ob_end_flush();
@readfile($file_path.$file_name);
  echo '<meta http-equiv=REFRESH CONTENT=0;url="./download.html">';
?>