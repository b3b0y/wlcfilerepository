<?php
session_start();
include_once("../php/config.php");
$stop = "";

$bol = false;


if(isset($_GET['Student']) && $_GET['Student'] == 'Student')
{
	if(isset($_POST['Fname']))
	{
		$Fname = mysql_escape_string(trim($_POST['Fname']));
	}
	if(isset($_POST['Lname']))
	{
		$Lname = mysql_escape_string(trim($_POST['Lname']));
	}

	if(isset($_POST['Mname']))
	{
		$Mname = mysql_escape_string(trim($_POST['Mname']));
	}

	if(isset($_POST['course']))
	{
		$course = mysql_escape_string(trim($_POST['course']));
	}

	if(isset($_POST['year']))
	{
		$year = mysql_escape_string(trim($_POST['year']));
	}

	if(isset($_POST['Idnum']))
	{
		$Idnum = mysql_escape_string(trim($_POST['Idnum']));
		
	}

	if(isset($_POST['pass'])) 
	{
		$pass = mysql_escape_string(trim($_POST['pass']));
	}

	$result = mysql_query("SELECT * FROM fr_stud") or die("Student Search Query : " . mysql_error());

		if(mysql_num_rows($result) > 0)
		{
			while ($row = mysql_fetch_array($result)) 
			{
				if($Idnum == $row['ControlNo'])
				{

					echo '<script> alert("Control number is already use");  window.location.href="../Admin.php?ViewStu=View"; </script>';
					//$_SESSION['CFail'] = "Control number is available";
					//$bol = true;
					//break;
					
				}
			}
		}

		if(!isset($row['ControlNo']))
		{
			mysql_query("INSERT INTO fr_user (UserName,UserPass,UserLvl,UserStat) VALUES ('".$Idnum."','".$pass."','1','pending')") or die("User Query  : "  . mysql_error());
			
			$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$Idnum."'");

			$row = mysql_fetch_array($result);

			mysql_query("INSERT INTO fr_stud (uid,ControlNo,FName,LName,Mname,Course,Year) VALUES ('".$row['UserID']."','".$Idnum."','".$Fname."','".$Lname."','".$Mname."','".$course."','".$year."')") or die("Stud Query  : "  . mysql_error());

			unset($_SESSION['genpass']);


			$res = mysql_query("SELECT fr_user.*,fr_staff.* FROM fr_user,fr_staff WHERE fr_user.UserName = '".$_SESSION['user']."' AND fr_user.UserID = fr_staff.uid") or die("Query IS wrong : " . mysql_error());

			if(mysql_num_rows($res) > 0)
			{
				$row = mysql_fetch_array($res);

				$name = $row['FirstN'] ." ". $row['LastN'];
				$State = $name." Added new Generated Account  ";

				mysql_query("INSERT INTO fr_rep(uid,Description,DateMod,UserLvl) VALUES('".$row['UserID']."','".$State."','".date ("d/m/y H:i:s")."','".$row['UserLvl']."')");

				echo '<script> alert("Successfully Added"); window.location.href="../Admin.php?ViewStu=View"; </script>';
			}
	
		}
}
else
{
	if(isset($_POST['uname']) || !trim($_POST['uname']) == "" || isset($stop)) 
	{
		$uname = mysql_escape_string(trim($_POST['uname']));
		$stop == 0;
	}
	if(isset($_POST['Ulevel']) || !trim($_POST['Ulevel']) == "" || isset($stop)) 
	{
		$ulvl = mysql_escape_string(trim($_POST['Ulevel']));
		$stop == 0;
	}

	if(isset($_POST['pass']) || !trim($_POST['pass']) == "" || isset($stop)) 
	{
		$pass = mysql_escape_string(trim($_POST['pass']));
		$stop == 0;
	}
	if(isset($_POST['repass']) || !trim($_POST['repass']) == "" || isset($stop)) 
	{
		$repass = mysql_escape_string(trim($_POST['repass']));
		$stop == 0;

	}

	if($ulvl > 1)
	{

		if(isset($_POST['Lname']) || !trim($_POST['Lname']) == "" || isset($stop)) 
		{
			$Lname = mysql_escape_string(trim($_POST['Lname']));
			$stop == 0;
		}

		if(isset($_POST['Fname']) || !trim($_POST['Fname']) == "" || isset($stop)) 
		{
			$Fname = mysql_escape_string(trim($_POST['Fname']));
			$stop == 0;
		}
		if(isset($_POST['Mname'])  || isset($stop)) 
		{
			$mname = mysql_escape_string(trim($_POST['Mname']));
			$stop == 0;

		}
	}
		if($pass == $repass)
		{
			
			$qry = mysql_query("SELECT UserName FROM fr_user") or die("Query : " . mysql_error());
			
			while ($row = mysql_fetch_array($qry)) 
			{
				unset($_SESSION['CFail']);
				unset($_SESSION['UFail']);
				
				if($uname == $row['UserName'])
				{
					$stop = 1;
					$_SESSION['lname'] = $Lname;
					$_SESSION['fname'] = $Fname;
					$_SESSION['mname'] = $mname;
					$_SESSION['ulvl'] = $ulvl;
					$_SESSION['UFail'] = "User Name is available";
					
					echo '<script> window.location.href="../Admin.php?AddAcct=Add"; </script>';
					break;
				}
				
			}
			
			if($stop == 0)
			{	

				if($ulvl == 3)
				{
					$path = $url."Instructor/".$Lname.', '.$Fname."";	

					$Ulevel = "Instructor";

					if(!file_exists($url."Instructor")) 
					{
					    if(mkdir($url."Instructor", 0700, true))
					    {
					    	mysql_query("INSERT INTO fr_path (pathName,Folder_Name,Parent_F) VALUES('".$url."Instructor"."','Instructor','1')");
					    }

					}
				}
				else if($ulvl == 4)
				{
					$path = $url."Dean/".$Lname.', '.$Fname."";		

					$Ulevel = "Dean";


					if(!file_exists($url."Dean")) 
					{
					   
					     if( mkdir($url."Dean", 0700, true))
					    {
					    	mysql_query("INSERT INTO fr_path (pathName,Folder_Name,Parent_F) VALUES('".$url."Dean"."','Dean','1')");
					    }
					}
				}
				
				$sql = "INSERT INTO fr_user (UserName,UserPass,UserLvl) VALUES ('".$uname."','".$pass."','".$ulvl."')";
				$qry = mysql_query($sql) or die("Account Query  : "  . mysql_error());

				if($ulvl > 1)
				{

					$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$uname."'");

					$row = mysql_fetch_array($result);

					//mysql_query("INSERT INTO fr_path (uid,pathName) VALUES('".$row['UserID']."','".$path."')") or die("Path Query  : "  . mysql_error());
					mysql_query("INSERT INTO fr_staff (uid,FirstN,LastN,midN) VALUES('".$row['UserID']."','".$Fname."','".$Lname."','".$mname."')") or die("Paths Query  : "  . mysql_error());
					
					mysql_query("UPDATE fr_user SET UserStat = 'offline' WHERE UserName = '".$uname."'");
					

					$result2 = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".$Ulevel."'");
					$row2 = mysql_fetch_array($result2);
					
					mysql_query("INSERT INTO fr_path(pathName,Folder_Name,Parent_F) VALUES('".$path."','".$Lname.', '.$Fname."','".$row2['pathID']."')");
					
					$result3 = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".$Lname.', '.$Fname."'");
					$row3 = mysql_fetch_array($result3);

					mysql_query("INSERT INTO fr_folder_owner(Fid,Uid) VALUES('".$row3['pathID']."','".$row['UserID']."')");

					mkdir ($path, 0700);
				
					mysql_query("INSERT INTO fr_user_permissions(uid,upload,download,download_folders,create_folders,share,change_pass,rename_F,delete_F) VALUES('".$row['UserID']."','1','1','1','0','0','1','0','0')");
				}



				unset($_SESSION['uname']);
				unset($_SESSION['lname']);
				unset($_SESSION['fname']);
				unset($_SESSION['mname']);
				unset($_SESSION['ulvl']);
				unset($_SESSION['CFail']);
				unset($_SESSION['UFail']);

				$res = mysql_query("SELECT fr_staff.*,fr_user.* FROM fr_staff, fr_user WHERE fr_user.UserName = '".$_SESSION['user']."' AND fr_user.UserID = fr_staff.uid") or die("Query IS wrong : " . mysql_error());

				if(mysql_num_rows($res) > 0)
				{
					$row = mysql_fetch_array($res);

					$name = $row['FirstN'] ." ". $row['LastN'];
					$State = $name." Added new Account  " .$Lname ." ". $Fname  ;

					mysql_query("INSERT INTO fr_rep(uid,Description,DateMod,UserLvl) VALUES('".$row['UserID']."','".$State."','".date ("d/m/y H:i:s")."','".$row['UserLvl']."')");
					
				}
				echo '<script> alert("Successfully Added"); window.location.href="../Admin.php?ViewSta=View"; </script>';

			}
		}
		else
		{
			$_SESSION['uname'] = $uname;
			$_SESSION['lname'] = $Lname;
			$_SESSION['fname'] = $Fname;
			$_SESSION['mname'] = $mname;
			$_SESSION['ulvl'] = $ulvl;
			$stop = 1;
			echo '<script> alert("Password did not match"); window.location.href="../Admin.php?AddAcct=Add"; </script>';
			
		}	
}
?>
