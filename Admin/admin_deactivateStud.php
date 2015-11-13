<?php
	include_once("../php/config.php");
	
	
		$rowCount = count($_POST["users"]);
		
		for($i=0; $i<$rowCount; $i++)
		{

			mysql_query("UPDATE fr_user SET  UserStat = 'Inactive'  WHERE UserName='".$_POST["users"][$i]."'");

			//mysql_query("DELETE FROM fr_user WHERE UserName='".$_POST["users"][$i]."'");

			//mysql_query("DELETE FROM fr_stud WHERE UserName='".$_POST["users"][$i]."'");
		}

	header("Location: ../Admin.php?ViewStu=View");
?>