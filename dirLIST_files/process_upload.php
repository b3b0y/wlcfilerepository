<?PHP
//dirLIST v0.3.0 file upload processor file
include_once("../php/config.php");
require('config.php');
require('functions.php');





$result = mysql_query("SELECT * FROM fr_user_permissions WHERE upload  = '1' AND uid = '".$_SESSION['uid']."'") or die ("folder error");
if(mysql_num_rows($result) > 0)
{


	if($file_uploads !=  1)
	{
		header("Location: ../index.php");
		exit;
	}
	//some servers return empty $_POST and $_FILES arrays when the file size is too large
	if(empty($_POST) || empty($_FILES))
	{
		//header("Location: ../index.php?err=".base64_encode("upload_error"));
		exit;
	}

	//check if file is too big
	if($_FILES['file']['error'] == 1)
	{
		header("Location: ../index.php?folder=".$_POST['folder']."&err=".base64_encode("size"));
		exit;
	}

	//check if any file was uploaded
	if($_FILES['file']['error'] == 4)
	{
		header("Location: ../index.php?folder=".$_POST['folder']."&err=".base64_encode("nofile"));
		exit;
	}

	$local_text = (empty($_SESSION['lang_id'])) ? set_local_text(0) : set_local_text($_SESSION['lang_id']);

	if($_POST['submit'] == $local_text['upload'])
	{
		$file_name = $_FILES['file']['name'];
		if(get_magic_quotes_gpc()) 
		{ 
			$file_name  = stripslashes($_FILES['file']['name']); 
		}

		echo $folder = basename(base64_decode($_POST['folder']));
		if(!empty($folder))
		{
			$result1 = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".$folder."'");
			if(mysql_num_rows($result1) > 0)
			{
				$row1 = mysql_fetch_array($result1);
				$result2 = mysql_query("SELECT * FROM fr_path  WHERE pathID = '".$row1['Parent_F']."'");
				$row2 = mysql_fetch_array($result2);
				$dir_to_browse = $row2['pathName']."/";
				(substr($folder, -1, 1) != "/" && !empty($folder) ? $folder .= "/" : $folder);
				$new_path = $dir_to_browse.$folder.$file_name;
			}
			else
			{

				$result1 = mysql_query("SELECT * FROM fr_ins_subject  WHERE Subject = '".$folder."'");
				if(mysql_num_rows($result1) > 0)
				{
					$row1 = mysql_fetch_array($result1);
					
					//$result2 = mysql_query("SELECT * FROM fr_path  WHERE pathID = '".$row1['Parent_F']."'");
					//$row2 = mysql_fetch_array($result2);

					$dir_to_browse = $row1['SubPath']."/";
					(substr($folder, -1, 1) != "/" && !empty($folder) ? $folder .= "/" : $folder);
					echo $new_path = $dir_to_browse.$file_name;
				}
				else
				{
					$result1 = mysql_query("SELECT * FROM  fr_stud_subject  WHERE Folder_Name = '".$folder."'");
					if(mysql_num_rows($result1) > 0)
					{
						$row1 = mysql_fetch_array($result1);

						$result2 = mysql_query("SELECT * FROM fr_ins_subject  WHERE ID = '".$row1['subID']."'");
						$row2 = mysql_fetch_array($result2);
						$dir_to_browse = $row2['SubPath']."/";
						(substr($folder, -1, 1) != "/" && !empty($folder) ? $folder .= "/" : $folder);
						echo $new_path = $dir_to_browse.$folder.$file_name;
						
					}
				}
			}
		}
		else
		{
			$result1 = mysql_query("SELECT * FROM fr_path  WHERE uid = '".$_SESSION['uid']."'");
			if(mysql_num_rows($result1) > 0)
			{
				$row1 = mysql_fetch_array($result1);

				$dir_to_browse = $row1['pathName']."/";
				
				$new_path = $dir_to_browse.$file_name;
			}
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
			
		
		if(move_uploaded_file($_FILES['file']['tmp_name'], $new_path))
		{
			header("Location: ../index.php?folder=".$_POST['folder']);
			exit;
		}	
		else
		{
			header("Location: ../index.php?folder=".$_POST['folder']."&err=".base64_encode("upload_error"));
			exit;
		}
	}
	else
	{
		header("Location: ../index.php?folder=".$_POST['folder']."&err=".base64_encode("upload_error"));
		exit;

	}


}
else
{
    echo "<script> alert('You cant Upload'); window.location.assign('../index.php'); </script>";
}

?>