<?php
$link = mysqli_connect('localhost','root','','product'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
}   


					$y=$_POST["Year"];$m=$_POST["Month"];$d=$_POST["Day"];
					$StartId=$_POST["StartId"];
					if($m<10)
						$m='0'.$m;
					if($d<10)
						$d='0'.$d;
					$Today_date=$y.'-'.$m.'-'.$d;  // Today's Date
					echo $Today_date."  產品資料";


		mysqli_query($link, 'SET CHARACTER SET utf8');
		mysqli_query($link,"SET collation_connection = 'utf8_unicode_ci'");
		
		if ( $result = mysqli_query($link, "SELECT ProductNum,MFDate,Defect FROM productinfo WHERE MFDate='$Today_date' limit '$index',10 ") ) 
		{ 
	
			$i=StartId;
			while( $row = mysqli_fetch_assoc($result) )
			{ 
				$pid[i]=$row["ProductNum"];
				$pDate[i]=$row["MFDate"];
				$pDef[i]=$row["Defect"];
				
				echo "<tr><td>".$pid[i]."</td>";
				echo "<td>".$pDate[i]."</td>";
				echo "<td>".$pDef[i]."</td>";
				
			} 
			mysqli_free_result($result); // 釋放佔用的記憶體 
		} 

			
?>
