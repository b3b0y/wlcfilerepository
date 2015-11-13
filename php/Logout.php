<?php date_default_timezone_set("Asia/Hong_Kong");
	session_start();
	include_once("config.php");

	$result = mysql_query("UPDATE fr_user SET UserStat = 'offline' , last_logout_date  = '".date ("y/m/d g:i:s")."' WHERE UserName = '".$_SESSION['user']."'");

		
		$State = $_SESSION['user'] ." Last Log-out ";

		$res = mysql_query("SELECT * FROM fr_user WHERE fr_user.UserName = '".$_SESSION['user']."'  ") or die("Query IS wrong : " . mysql_error());

		if(mysql_num_rows($res) > 0)
		{
			$row = mysql_fetch_array($res);

			mysql_query("INSERT INTO fr_rep(UserName,Description,DateMod,UserLvl) VALUES('".$_SESSION['user']."','".$State."','".date ("d/m/y g:i:s")."','".$row['UserLvl']."')");

		}

		
		unset($_SESSION['login']); 
		session_destroy();
		header("Location: ../Index.php");


?>