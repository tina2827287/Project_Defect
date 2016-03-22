<?php
$link = mysqli_connect('localhost','root','','product'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
}   
        $y=$_POST["Year"];$m=$_POST["Month"];$d=$_POST["Day"];
        $KeyWord=$_POST["keyword"];
        $StartId=$_POST["StartId"];
$searchtype=$_POST["searchtype"];
        $Today_date=$y.'-'.$m.'-'.$d;  // Today's Date


mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");
	
if($searchtype=='default')
{
 
    if ( $result = mysqli_query($link, "SELECT Pnum,MFDate,Defect FROM productinfo WHERE MFDate='$Today_date' limit $StartId,10") ) 
		{ 
            
            while($row = mysqli_fetch_array($result))
            { 

                    $pid=$row["Pnum"];
                    $pDate=$row["MFDate"];
                    $pDef=$row["Defect"];
                
if($pDef=='Y')
{
     $return = "<h3>
                            <span class=\"ProductNum\">".$pid."</span>
                            <span class=\"Date\">".$pDate."</span>
                            <span class=\"Def-Icon\"><i class=\"fa fa-check-circle-o\"></i></span>
                        </h3>".
                        "<div>
                        <a href=\"./img/".$pid.".bmp\" target=\"_blank\">
                        <img src=\"./img/".$pid.".bmp\" alt=\"\"></a>
                        </div>";
                echo $return;    
}
if($pDef=='N')
{
     $return = "<h3>
                            <span class=\"ProductNum\">".$pid."</span>
                            <span class=\"Date\">".$pDate."</span>
                            <span class=\"Def-Icon\"><i class=\"fa fa-times-circle-o\"></i></span>
                        </h3>".
                        "<div>
                        <a href=\"./img/".$pid.".bmp\" target=\"_blank\">
                        <img src=\"./img/".$pid.".bmp\" alt=\"\"></a>
                        </div>";
                echo $return;    
}
                   
             }  
            //$i=0;
               
			mysqli_free_result($result); // 釋放佔用的記憶體 
		} 

    
    
    
    
}
		



		
?>