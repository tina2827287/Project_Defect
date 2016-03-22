<?php
$link = mysqli_connect('localhost','root','','product'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
}   
        $y=$_POST["Year"];$m=$_POST["Month"];$d=$_POST["Day"];
        $KeyWord=$_POST["keyword"];
        $StartId=$_POST["StartId"];
        $Today_date=$y.'-'.$m.'-'.$d;  // Today's Date
$StartId=$StartId+1;


		mysqli_query($link, 'SET CHARACTER SET utf8');
		mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");
		echo "StartId: ".$StartId;
	/*	if ( $result = mysqli_query($link, "SELECT ProductNum,MFDate,Defect FROM productinfo WHERE MFDate='$Today_date' limit '$StartId',10 ") ) 
		{ 
	
			$i=StartId;
			while( $row = mysqli_fetch_assoc($result) )
			{ 
				$pid[i]=$row["ProductNum"];
				$pDate[i]=$row["MFDate"];
				$pDef[i]=$row["Defect"];
				

                
                
                echo " <h3>
                    <span class='ProductNum'>".$pid[i]."</span>
                    <span class='Date'>".$pDate[i]."</span>
                    <span class='Def-Icon'>".$pDef[i]."</span>
                </h3>".
                "<div>
                <a href='./img/".$pid[i]."bmp' target='_blank'>
                <img src='./img/".$pid[i]."bmp' alt=''></a>
                </div>";
                
			} 
			mysqli_free_result($result); // 釋放佔用的記憶體 
		} */

			
?>