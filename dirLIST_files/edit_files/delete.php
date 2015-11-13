<?PHP 

if(empty($_GET['item_name']))
	die('item_name empty');

include_once("../../php/config.php");
require('../config.php');
require('../functions.php');


	$result1 = mysql_query("SELECT * FROM fr_user WHERE UserName ='".$_SESSION['user']."'");

	$row = mysql_fetch_array($result1);

	$result = mysql_query("SELECT * FROM fr_user_permissions WHERE delete_F  = '1' AND uid = '".$row['UserID']."'") or die ("folder error");
	if(mysql_num_rows($result) == 0)
	{
		if($listing_mode == 0) //http deletion
		{
			if(!empty($_GET['folder']))
			{
				$folder = basename($_GET['folder']);
				$file_name = basename(base64_decode($_GET['item_name']));
				$result1 = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".$folder."'");
				if(mysql_num_rows($result1) > 0)
				{
					$row1 = mysql_fetch_array($result1);
					
					$dir_to_browse = $row1['pathName']."/";
					(substr($folder, -1, 1) != "/" && !empty($folder) ? $folder .= "/" : $folder);
					$item_path = $dir_to_browse.$file_name;
				}
				else
				{

					$result1 = mysql_query("SELECT * FROM fr_ins_subject  WHERE Subject = '".$folder."'");
					if(mysql_num_rows($result1) > 0)
					{
						$row1 = mysql_fetch_array($result1);

						$dir_to_browse = $row1['SubPath']."/";
						(substr($folder, -1, 1) != "/" && !empty($folder) ? $folder .= "/" : $folder);
						$item_path = $dir_to_browse.$file_name;

					}
					else
					{
						$result1 = mysql_query("SELECT * FROM  fr_stud_subject  WHERE Folder_Name = '".$folder."'");
						if(mysql_num_rows($result1) > 0)
						{
							$row1 = mysql_fetch_array($result1);

							$dir_to_browse = $row1['SubPath']."/";
							(substr($folder, -1, 1) != "/" && !empty($folder) ? $folder .= "/" : $folder);
							$item_path = $dir_to_browse.$file_name;	
						}
					}
				}
			}
			else
			{
				$result1 = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".basename(base64_decode($_GET['item_name']))."'");
				$row1 = mysql_fetch_array($result1);
				$item_path = $row1['pathName'];
				 
			}
			

			
			if(is_dir($item_path.'/'))
			{
				$result1 = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".basename(base64_decode($_GET['item_name']))."'");
				if(mysql_num_rows($result1) > 0)
				{
					$row1 = mysql_fetch_array($result1);
					mysql_query("DELETE FROM fr_path WHERE Folder_Name = '".basename(base64_decode($_GET['item_name']))."'");
					mysql_query("DELETE FROM  fr_folder_owner WHERE Fid = '".$row1['pathID']."'");
				}
				else
				{
					$result1 = mysql_query("SELECT * FROM  fr_ins_subject  WHERE Subject = '".basename(base64_decode($_GET['item_name']))."' AND Folder_Owner = '".$_SESSION['uid']."'");
					$row1 = mysql_fetch_array($result1);
					mysql_query("DELETE FROM  fr_ins_subject WHERE Subject = '".basename(base64_decode($_GET['item_name']))."'");
					mysql_query("DELETE FROM  fr_folder_owner WHERE Fid = '".$row1['ID']."'");
				}
				

				delete_directory($item_path.'/', 0);
			}
			elseif(is_file($item_path))
			{
				unlink($item_path);
				echo $item_path;

			}
				
			header("Location: ../../index.php?folder=".base64_encode($_GET['folder']));
			exit;
			

		}
		elseif($listing_mode == 1) //ftp deletion
		{
			if(!empty($_POST['folder']))
			{
				$item_path = $dir_to_browse2.base64_decode($_GET['folder']);
			}
			else
			{
				$result = mysql_query("SELECT * FROM fr_path  WHERE uid = '".$_SESSION['uid']."'");
				$row = mysql_fetch_array($result);
				$item_path = $row['pathName'].base64_decode($_GET['folder']);
			}
			
			$item_path .= (empty($_GET['folder'])) ? base64_decode($_GET['item_name']) : '/'.base64_decode($_GET['item_name']);
			
			$ftp_stream = ftp_connect($ftp_host);
			ftp_login($ftp_stream, $ftp_username, $ftp_password);
			
			if(ftp_size($ftp_stream, $item_path) != '-1')
				@ftp_delete($ftp_stream, $item_path);
			else
				delete_directory($item_path.'/', 1);
			
			header("Location: ../../index.php?folder=".$_GET['folder']);
			exit;

		}
	}
	else
	{
		echo "<script> alert('You cant Delete folders'); window.location.assign('../../index.php?folder=".$_GET['folder']."'); </script>";
	}
?>