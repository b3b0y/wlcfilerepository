<?PHP
session_start();
error_reporting(0);
set_time_limit(0);
include_once("../php/config.php");
require("config.php");

$_GET['file'] = base64_encode(rawurldecode(base64_decode($_GET['file']))); //this is messy i know, will fix it up

if($listing_mode == 0)
{
	//$result = mysql_query("SELECT * FROM fr_path  WHERE uid = '".$_SESSION['uid']."'");
	//$row = mysql_fetch_array($result);

	//$dir_to_browse2 = $row['pathName'];

	//echo $file_path = $dir_to_browse2.'/'.basename(base64_decode($_GET['folder'])).'/'.base64_decode($_GET['item_name']);
	 $file_name = basename(base64_decode($_GET['item_name']));
	 $folder = basename(base64_decode($_GET['folder']));
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
			$file_path = $dir_to_browse.$folder.$file_name;
		}
		else
		{

			$result1 = mysql_query("SELECT * FROM fr_ins_subject  WHERE Subject = '".$folder."'");
			if(mysql_num_rows($result1) > 0)
			{
				$row1 = mysql_fetch_array($result1);

				$dir_to_browse = $row1['SubPath']."/";
				(substr($folder, -1, 1) != "/" && !empty($folder) ? $folder .= "/" : $folder);
				$file_path = $dir_to_browse.$file_name;
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
					 $file_path = $dir_to_browse.$file_name;
					
				}
			}
		}
	}
	else
	{
		$result1 = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".$file_name."'");
		if(mysql_num_rows($result1) > 0)
		{
			$row1 = mysql_fetch_array($result1);
			$result2 = mysql_query("SELECT * FROM fr_path  WHERE pathID = '".$row1['Parent_F']."'");
			$row2 = mysql_fetch_array($result2);
			$dir_to_browse = $row2['pathName']."/";
			(substr($file_name, -1, 1) != "/" && !empty($file_name) ? $file_name .= "/" : $file_name);
			 $file_path = $dir_to_browse.$file_name;
		}
		else
		{

			$result1 = mysql_query("SELECT * FROM fr_ins_subject  WHERE Subject = '".$file_name."'");
			if(mysql_num_rows($result1) > 0)
			{
				$row1 = mysql_fetch_array($result1);
				
				$result2 = mysql_query("SELECT * FROM fr_path  WHERE pathID = '".$row1['Parent_F']."'");
				$row2 = mysql_fetch_array($result2);

				$dir_to_browse = $row2['pathName']."/";
				(substr($file_name, -1, 1) != "/" && !empty($file_name) ? $file_name .= "/" : $file_name);
				 $file_path = $dir_to_browse.$file_name;
			}
			else
			{
				$result1 = mysql_query("SELECT * FROM  fr_stud_subject  WHERE Folder_Name = '".$file_name."'");
				if(mysql_num_rows($result1) > 0)
				{
					$row1 = mysql_fetch_array($result1);

					$result2 = mysql_query("SELECT * FROM fr_ins_subject  WHERE ID = '".$row1['subID']."'");
					$row2 = mysql_fetch_array($result2);
					$dir_to_browse = $row2['SubPath']."/";
					(substr($file_name, -1, 1) != "/" && !empty($file_name) ? $file_name .= "/" : $file_name);
					 $file_path = $dir_to_browse.$file_name;
				}
			}
		}
	}
}

//Security feature to prevent downloading of files above $dir_to_browse
if(count($dir_to_browse2.'/'.basename(base64_decode($_GET['folder'])).'/'.base64_decode($_GET['item_name'])) > count($dir_to_browse2))
	die('Access Denied');

//Deny access to files and folders that have been excluded
foreach($exclude as $val)
{
	if($val != '.' && $val != '..')
	{
		if(count(explode($val, $dir_to_browse2.'/'.basename(base64_decode($_GET['folder'])).'/'.base64_decode($_GET['item_name']))) > 1)
			die('Access Denied');			  
	}
}

//Check if valid file
$file_valid = FALSE;
if(is_file($file_path))
{

	//At this stage, it is assumed that the file is valid and to proceed with prompting the user to download it

	$file_name = str_replace(array('+', " "), array('_','_'), basename($file_path));

	header('Cache-control: private');
	header('Content-Type: application/octet-stream'); 
	header('Content-Length: '.filesize($file_path));
	header('Content-Disposition: attachment; filename='.$file_name);
	ob_flush();

	$fh = ($listing_mode == 0) ? fopen($file_path, "r") : fopen('ftp://'.$ftp_username.':'.$ftp_password.'@'.$ftp_host.'/'.$file_path, "r");

	while(!feof($fh))
	{
		echo ($listing_mode == 0) ?  fread($fh, round($speed*1024, 0)) : fread($fh, 1048576);
		ob_flush();
		if($listing_mode == 0) sleep(1);
	}
	fclose($fh);
	exit;
	}
else
{
	$result1 = mysql_query("SELECT * FROM fr_user WHERE UserName ='".$_SESSION['user']."'");

	$row = mysql_fetch_array($result1);

	$result = mysql_query("SELECT * FROM fr_user_permissions WHERE download_folders  = '1' AND uid = '".$row['UserID']."'") or die ("folder error");
	if(mysql_num_rows($result) > 0)
	{
		$file_name = str_replace(array('+', " "), array('_','_'), basename($file_path));
		$the_folder = $file_path;
		$zip_file_name = $file_name.'.zip';


		$download_file= true;

		class FlxZipArchive extends ZipArchive {
		    /** Add a Dir with Files and Subdirs to the archive;;;;; @param string $location Real Location;;;;  @param string $name Name in Archive;;; @author Nicolas Heimann;;;; @access private  **/

		    public function addDir($location, $name) {
		        $this->addEmptyDir($name);

		        $this->addDirDo($location, $name);
		     } // EO addDir;

		    /**  Add Files & Dirs to archive;;;; @param string $location Real Location;  @param string $name Name in Archive;;;;;; @author Nicolas Heimann
		     * @access private   **/
		    private function addDirDo($location, $name) {
		        $name .= '/';
		        $location .= '/';

		        // Read all Files in Dir
		        $dir = opendir ($location);
		        while ($file = readdir($dir))
		        {
		            if ($file == '.' || $file == '..') continue;
		            // Rekursiv, If dir: FlxZipArchive::addDir(), else ::File();
		            $do = (filetype( $location . $file) == 'dir') ? 'addDir' : 'addFile';
		            $this->$do($location . $file, $name . $file);
		        }
		    } // EO addDirDo();
		}

		$za = new FlxZipArchive;
		$res = $za->open($zip_file_name, ZipArchive::CREATE);
		if($res === TRUE) 
		{
		    $za->addDir($the_folder, basename($the_folder));
		    $za->close();
		}
		else  { echo 'Could not create a zip archive';}

		if ($download_file)
		{
		    ob_get_clean();
		    header("Pragma: public");
		    header("Expires: 0");
		    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		    header("Cache-Control: private", false);
		    header("Content-Type: application/zip");
		    header("Content-Disposition: attachment; filename=" . basename($zip_file_name) . ";" );
		    header("Content-Transfer-Encoding: binary");
		    header("Content-Length: " . filesize($zip_file_name));
		    readfile($zip_file_name);
		    ob_flush();

		    if(is_dir($zip_file_name.'/'))
			delete_directory($zip_file_name.'/', 0);
			elseif(is_file($zip_file_name))
				unlink($zip_file_name);
			exit;
		}
	}
	else
	{
		echo "<script> alert('You cant download folders'); window.location.assign('../index.php?folder=".$_GET['folder']."'); </script>";
	}
	
}



?>