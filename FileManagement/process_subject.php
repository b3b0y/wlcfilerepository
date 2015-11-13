<?php
include_once("../php/config.php");
include("../php/php_file_tree.php");
require('../dirLIST_files/config.php');
require('../dirLIST_files/functions.php');


$result1 = mysql_query("SELECT * FROM fr_user WHERE UserName ='".$_SESSION['user']."'");

$row = mysql_fetch_array($result1);

$result = mysql_query("SELECT * FROM fr_user_permissions WHERE upload  = '1' AND uid = '".$_SESSION['uid']."'") or die ("folder error");
if(mysql_num_rows($result) > 0)
{
	if(!isset($_SESSION['login'])) 
	{
        header("Location: Login.php");
	} 

	$result = mysql_query("SELECT * FROM fr_user WHERE UserName ='".$_SESSION['user']."'") or die("Path Query  : "  . mysql_error());

	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_array($result);

		$State = $row['UserName'] ." is Created a New Folder ".$_POST['file'];

		
			$file_name = $_POST['file'];
			if(get_magic_quotes_gpc()) 
			{ 
				$file_name  = stripslashes($_POST['file']); 
			}

			$folder = base64_decode(trim($_POST['folder']));
			(substr($folder, -1, 1) != "/" && !empty($folder) ? $folder .= "/" : $folder);
				if(!empty($_POST['folder']))
				{
					$folder_array = explode("/", base64_decode($_POST['folder']));
					$folder = $folder_array[count($folder)]; 

					$result = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".$folder."' AND uid = '".$_SESSION['uid']."'");
					$row = mysql_fetch_array($result);
					

					$result2 = mysql_query("SELECT * FROM fr_path  WHERE pathID = '".$row['Parent_F']."'");
					$row2 = mysql_fetch_array($result2);
					
					$dir_to_browse2 = $row2['pathName']."/";
					$dir_to_browse2 .= $folder."/";

						$new_path = $dir_to_browse2.$file_name;	
				}
				else
				{
					$result = mysql_query("SELECT * FROM fr_path  WHERE uid = '".$_SESSION['uid']."'");
					$row = mysql_fetch_array($result);
					$dir_to_browse_base = $row['pathName'];
					$new_path = $row['pathName']."/".$file_name;
				}


			if(in_array(strtolower(strrchr($file_name, ".")), $banned_file_types))
			{
				header("Location: ../index.php?folder=".$_POST['folder']."&err=".base64_encode("upload_banned"));
				exit;
			}

			$same_file_counter = 1;
			
			while(is_file($new_path))
			{
				$file_ext_comp = strrchr($file_name, '.');
				$file_name_comp = substr($file_name, 0, -strlen($file_ext_comp));
				$new_path = $dir_to_browse.$folder.$file_name_comp.'['.$same_file_counter.']'.$file_ext_comp;																																										
				$same_file_counter++;
			}
			if(!is_dir($new_path))
			{
				if(isset($_POST['folder']) && $_POST['folder'] != "")
				{
					$folder_array = explode("/", base64_decode($_POST['folder']));
					$folder = $folder_array[count($folder)]; 
				}
				else
				{
					$folder = basename($dir_to_browse_base);
				}
				
				mysql_query("INSERT INTO fr_rep(uid,Description,DateMod) VALUES('".$_SESSION['uid']."','".$State."','".date ("d/m/y H:i:s")."')");
				
				$result = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".$folder."'");
				$row = mysql_fetch_array($result);
				
				mysql_query("INSERT INTO  fr_ins_subject(uid,SubPath,Subject,Parent_F) VALUES('".$_SESSION['uid']."','".$new_path."','".$file_name."','".$row['pathID']."')");
				
				$result2 = mysql_query("SELECT * FROM  fr_ins_subject  WHERE Subject = '".$file_name."'");
				$row2 = mysql_fetch_array($result2);

				mysql_query("INSERT INTO fr_folder_owner(Fid,Uid) VALUES('".$row2['ID']."','".$_SESSION['uid']."')");
				mkdir ($new_path, 0700);
				header("Location: ../index.php?folder=".$_POST['folder']);
				exit;
			}
			else
			{
				echo "<script> alert('Folder already Exists'); window.location.href='../index.php'; </script>";

			}
			
		}
		else
		{
			//header("Location: ../index.php?folder=".$_POST['folder']."&err=".base64_encode("upload_error"));
			//exit;
			echo $new_path;
		}
}
else
{
    echo "<script> alert('You cant Create Folder'); window.location.assign('../index.php'); </script>";
}	

?>