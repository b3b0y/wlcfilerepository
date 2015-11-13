<?php date_default_timezone_set("Asia/Hong_kong");
	session_start();

	include_once("../php/config.php");


		$rowCount = count($_POST['subject']);
			
		for($i=0; $i<$rowCount; $i++)
		{
			$result = mysql_query("SELECT * FROM  fr_stud_subject WHERE sID = '".$_POST['subject'][$i]."'");
			if(mysql_num_rows($result) > 0)
			{
				$row = mysql_fetch_array($result);
				$path = $row['SubPath'];
				$date = date ("y/m/d");
				$time = date ("H:i:s");

				mysql_query("UPDATE fr_stud_subject SET Date_Created = '".$date."', Time_Created = '".$time."', status = 'APPROVED' WHERE sID = '".$_POST['subject'][$i]."'");

				if(!is_dir($path))
    			{
    				mkdir ($path, 0700);
    			}
			}
		}

	echo '<script> alert("Successfully APPROVED"); window.location.href="../Admin.php?approval=Subject"; </script>';

?>