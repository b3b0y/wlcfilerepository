 <?php 
session_start();
include_once("../php/config.php");

	$Idnum = "";
	$Fname = "";
	$Mname = "";
	$Lname = "";
	$course = "";
	$year = "";
	$pass = "";

if (isset($_POST['Submit'])) {

    //get the csv file
    $file = $_FILES['csv']['tmp_name'];
    $handle = fopen($file,"r");
    
	$firstline = true;
	while (($data = fgetcsv($handle, 10000, ",")) !== FALSE)
	{
		if (!$firstline) 
		{
			$Idnum = addslashes($data[0]);
			$Fname = addslashes($data[1]);
			$Mname = addslashes($data[2]);
			$Lname = addslashes($data[3]);
			$course = addslashes($data[4]);
			$year = addslashes($data[5]);
			$pass = addslashes($data[6]);


			$result = mysql_query("SELECT * FROM fr_stud WHERE ControlNo = '".$Idnum."'") or die("Student Search Query : " . mysql_error());

			if(mysql_num_rows($result) == 0)
			{
				
				mysql_query("INSERT INTO fr_user (UserName,UserPass,UserLvl,UserStat) VALUES ('".$Idnum."','".$pass."','1','pending')") or die("User Query  : "  . mysql_error());


				$res = mysql_query("SELECT fr_user.*,fr_staff.* FROM fr_user,fr_staff WHERE fr_user.UserName = '".$_SESSION['user']."' AND fr_user.UserID = fr_staff.uid") or die("Query IS wrong : " . mysql_error());

				if(mysql_num_rows($res) > 0)
				{
					$row = mysql_fetch_array($res);

					$name = $row['FirstN'] ." ". $row['LastN'];
					$State = $name." Added new Generated Account  ";

					mysql_query("INSERT INTO fr_rep(uid,Description,DateMod,UserLvl) VALUES('".$row['UserID']."','".$State."','".date ("d/m/y H:i:s")."','".$row['UserLvl']."')");

				}
			}

			$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$Idnum."'");

			$row = mysql_fetch_array($result);

			mysql_query("INSERT INTO fr_stud (uid,ControlNo,FName,LName,Mname,Course,Year) VALUES ('".$row['UserID']."','".$Idnum."','".$Fname."','".$Lname."','".$Mname."','".$course."','".$year."') ON DUPLICATE KEY UPDATE ControlNo ='".$Idnum."', FName = '".$Fname."' , LName = '".$Lname."', Mname = '".$Mname."' , Course = '".$course."' , Year = '".$year."'") or die("Stud Query  : "  . mysql_error());


		}
		$firstline = false;
	}
	echo '<script> alert("Successfully Added"); window.location.href="../Admin.php?ViewStu=View"; </script>';
}

	
?>

