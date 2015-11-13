<?php date_default_timezone_set("Asia/Hong_Kong");
	session_start();
	include_once("config.php");
	$cont = "";


	if($_GET['Check'] == 'Y')
	{
		$result = mysql_query("SELECT * FROM fr_user WHERE UserName = '".$_POST['uname']."'");

		if(mysql_num_rows($result) > 0)
		{
			while ($acct = mysql_fetch_array($result)) 
			{
				if($_POST['uname'] == $acct['UserName'])
				{
					echo '<script> alert("Username is already use");  window.location.href="../Required.php"; </script>';
				}
			}
		}
		else
		{
			if($_POST['Npass'] == $_POST['Conpass'])
			{
				
				$result = mysql_query("SELECT * FROM fr_stud WHERE ControlNo = '".$_SESSION['user']."'");

				$row = mysql_fetch_array($result);

				$result1 = mysql_query("SELECT * FROM fr_user WHERE UserID = '".$row['uid']."'");

				$row1 = mysql_fetch_array($result1);

				$result2 = mysql_query("SELECT * FROM Position WHERE UserLvl = '".$row1['UserLvl']."'");

				$row2 = mysql_fetch_array($result2);
				//Create Folder
				$path  = $url.$row2['Position']."/".$row['Course'].'/'.$row['LName'].'-'.$row['ControlNo']."";
				
				if(!file_exists($url.$row2['Position']."/".$row['Course'])) 
				{
				    
				     if(mkdir($url.$row2['Position']."/".$row['Course'], 0700, true))
				    {
				    	mysql_query("INSERT INTO fr_path (pathName,Folder_Name,Parent_F) VALUES('".$url.$row2['Position']."','".$row2['Position']."','1')");
				    	$result4 = mysql_query("SELECT * FROM fr_path WHERE Folder_Name = '".$row2['Position']."'");
				    	$row4 = mysql_fetch_array($result4);
				    	mysql_query("INSERT INTO fr_path (pathName,Folder_Name,Parent_F) VALUES('".$url.$row2['Position']."/".$row['Course']."','".$row['Course']."','".$row4['pathID']."')");
				    }
				}
				//update login status
			
				mysql_query("UPDATE fr_user SET UserStat = 'offline' , UserName = '".$_POST['uname']."' , UserPass = '".$_POST['Npass']."' WHERE UserName = '".$_SESSION['user']."'");

				 $State = $row['FName']." ". $row['LName'] ."Account has been Activated ";

				//insert report
				mysql_query("INSERT INTO fr_rep(uid,Description,DateMod) VALUES('".$row['uid']."','".$State."','".date ("d/m/y H:i:s")."')");
				
				mysql_query("INSERT INTO fr_user_permissions(uid,upload,download,download_folders,create_folders,share,change_pass,rename_F,delete_F) VALUES('".$row['uid']."','1','1','1','0','0','1','0','0')");
					//insert path folder to database
					$result3 = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".$row['Course']."'");
					$row3 = mysql_fetch_array($result3);
					
					mysql_query("INSERT INTO fr_path(pathName,Folder_Name,Parent_F) VALUES('".$path."','".$row['LName'].'-'.$row['ControlNo']."','".$row3['pathID']."')");
					
					//insert owner folder to database
					$result4 = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".$row['LName'].'-'.$row['ControlNo']."'");
					$row4 = mysql_fetch_array($result4);

					mysql_query("INSERT INTO fr_folder_owner(Fid,Uid) VALUES('".$row4['pathID']."','".$row['uid']."')");
					mkdir ($path, 0700);

				$_SESSION['cUser'] = $_POST['uname'];
				$_SESSION['cpass'] = $_POST['Npass'];
				$_SESSION['cont'] = 1;
				echo '<script> alert("Your account is Successfully Activate Press ok to Login"); window.location.href="chkpass.php"; </script>';
			}
			else
			{
				echo '<script> alert("Confirm password not match");  window.location.href="../Required.php"; </script>';
				
			}
		}
		
	}
	else if($_GET['Cancel'] == 'X')
	{
		header("Location: ../index.php");
	}

?>