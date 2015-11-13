<?php date_default_timezone_set("Asia/Hong_Kong");

session_start();
include_once("config.php");
include("php_file_tree.php");

	if(!isset($_SESSION['login'])) 
	{
            header("Location: Login.php");
	} 
	$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['user']."'");

	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result);
		
		$result = mysql_query("SELECT * FROM fr_path WHERE uid ='".$row['UserID']."'") or die("Path Query  : "  . mysql_error());

		if(mysql_num_rows($result) > 0)
		{
			$row = mysql_fetch_array($result);

			$State = $row['UserName'] ." is Created a New Folder ".$_POST['fileName'];

			mysql_query("INSERT INTO fr_rep(uid,Description,DateMod) VALUES('".$row['UserID']."','".$State."','".date ("d/m/y H:i:s")."')");

			if($_SESSION['login'] == "ADMIN")
			{
				$path  = $row['pathName']."/".$_POST['fileName']."";
		        mkdir ($path, 0700);
		        header("Location: ../index.php");
				 
			}
			else if($_SESSION['login'] == "DEAN")
			{
				$path = $row['pathName']."/".$_POST['fileName']."";
				mkdir ($path, 0700);
				header("Location: ../index.php");
			}
			else if($_SESSION['login'] == "Instructor")
			{
				$path = $row['pathName']."/".$_POST['fileName']."";
				mkdir ($path, 0700);
				header("Location: ../index.php");
			}
			else if($_SESSION['login'] == "Student")
			{
				$path  = $row['pathName']."/".$_POST['fileName']."";
				mkdir ($path, 0700);
				header("Location: ../index.php");
			}
		}
		else
		{

			echo '<script> alert("atay") </script>';
		}
	}
	else
		{

			echo '<script> alert("atay") </script>';
		}



?>