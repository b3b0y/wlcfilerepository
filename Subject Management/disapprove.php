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

				mysql_query("DELETE FROM fr_stud_subject WHERE sID = '".$_POST['subject'][$i]."'");
			}
		}

	echo '<script> alert("Successfully DISAPPROVED"); window.location.href="./Admin.php?approval=Subject"; </script>';

?>