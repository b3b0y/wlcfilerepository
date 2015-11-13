<?php session_start();
	date_default_timezone_set("Asia/Hong_Kong");
	include_once("config.php");

	if(isset($_SESSION['cont']) && $_SESSION['cont'] == 1)
	{
		$uname = $_SESSION['cUser'];
		$pass = $_SESSION['cpass'];
		$_SESSION['user'] = $_SESSION['cUser'];

		
	}
	else
	{
		$uname = $_POST['user'];
		$pass = $_POST['pass'];
		$_SESSION['user'] = $_POST['user'];
	}


	function clean($value) {

		if(get_magic_quotes_gpc()) $value = stripslashes($value);
		return trim(mysql_real_escape_string($value));
	}

	$sql = "SELECT * FROM fr_user WHERE UserName = '".$uname."'";
	$qry = mysql_query($sql) or die("Query IS wrong : " . mysql_error());
	$num = mysql_num_rows($qry);

	$row = mysql_fetch_array($qry);
	$_SESSION['Ulvl'] = $row['UserLvl'];
	if($row['UserStat'] != 'live')
	{
		if ($num==0 || $pass!=$row['UserPass']) //check if the pass is in the database
		{
			//failed to login
			echo "<script> alert('Username or Password Incorrect'); 
					window.location.assign('../index.php') </script>";

			
		} 
		else
		{
			$_SESSION['uid'] = $row['UserID'];
			if($row['activate'] == 0)
			{
				echo "<script> alert('Your account has been Deactivated, Please contact you school Administrator!'); 
					 	window.location.assign('../index.php') </script>";
			}
			else
			{
				if($row['UserStat'] == 'offline')
				{
					mysql_query("UPDATE fr_user SET UserStat = 'live' , last_login_date  = '".date ("y/m/d g:i:s")."' WHERE UserName = '".$uname."'");
					

					
					$State = $_POST['user']." Last Log-in ";

					$res = mysql_query("SELECT * FROM fr_user WHERE fr_user.UserName = '".$_SESSION['user']."'  ") or die("Query IS wrong : " . mysql_error());

					if(mysql_num_rows($res) > 0)
					{
						$row = mysql_fetch_array($res);

						mysql_query("INSERT INTO fr_rep(uid,Description,DateMod,UserLvl) VALUES('".$row['UserID']."','".$State."','".date ("d/m/y H:i:s")."','".$row['UserLvl']."')");

					}

					if($row['UserLvl'] >= 3 ) //check if User level is 5
					{
						$_SESSION['login'] = "ADMIN";
						$_SESSION['UserLvl'] = $row['UserLvl'];
						header("Location: ../index.php");
					
					
					}
					
					if($row['UserLvl'] == 1) //check if User level is 1
					{
						$_SESSION['login'] = "Student";
						$_SESSION['UserLvl'] = $row['UserLvl'];
						header("Location: ../index.php");
					}
				}
				else if($row['UserStat'] == 'pending')
				{

					header("Location: ../Required.php");
				}
			}

		}
	}
	else
	{
		echo "<script> alert('Account is used by someone else please choose other Account'); 
					window.location.assign('../index.php') </script>";
	}

?>