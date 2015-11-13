<?PHP 
session_start();
//configuration file

//Listing mode. 0:HTTP directory Listing 1:FTP directory listing
$listing_mode = 0;

//Directory to browse ***INCLUDING TRAILING SLASH***. Leave it as "./" if you want to browse the directory this file is in for HTTP listing or leave it blank for browsing the root directory for FTP listing.  This can be an absolute or relative path (relative to the index.php file). CAUTION: Listing a directory above your web root will cause errors.
 
	

	if($_SESSION['UserLvl'] > 3)
	{
		$result = mysql_query("SELECT fr_path.*,fr_folder_owner.* FROM fr_path,fr_folder_owner  WHERE fr_folder_owner.Fid = fr_path.pathID AND fr_folder_owner.uid = '".$_SESSION['uid']."'")or die(mysql_error());
		if(mysql_num_rows($result) > 0)
		{
			while($row = mysql_fetch_array($result)){
				   echo $dir_to_browse[] = $row['pathName']."/";
			}
		}
	}
	else
	{
		$result = mysql_query("SELECT fr_path.*,fr_folder_owner.* FROM fr_path,fr_folder_owner  WHERE fr_folder_owner.Fid = fr_path.pathID AND fr_folder_owner.uid = '".$_SESSION['uid']."'")or die(mysql_error());
		if(mysql_num_rows($result) > 0)
		{
			while($row = mysql_fetch_array($result)){
				 $dir_to_browse[] = $row['pathName']."/";
			}
		}
		$result2 = mysql_query("SELECT * FROM  fr_stud_subject  WHERE studID = '".$_SESSION['uid']."' AND status = 'APPROVED'");
		if(mysql_num_rows($result2) > 0)
		{
			while ($row2 = mysql_fetch_array($result2)) 
			{
				$result3 = mysql_query("SELECT * FROM  fr_ins_subject  WHERE ID = '".$row2['subID']."'");
				$row3 = mysql_fetch_array($result3);
					$dir_to_browse[] = $row3['SubPath']."/";
			}	
		}

		$result3 = mysql_query("SELECT * FROM fr_share_folder  WHERE studID = '".$_SESSION['uid']."'") or die (mysql_error());	
		if(mysql_num_rows($result3) > 0)
		{
			while ($row3 = mysql_fetch_array($result2)) 
			{
				$result4 = mysql_query("SELECT * FROM  fr_ins_subject  WHERE ID = '".$row3['subID']."'");
				$row4 = mysql_fetch_array($result4);
					$dir_to_browse[] = $row4['SubPath']."/";
			}	
		}
	}
	
	


	
	
	
	
			
	$dir_to_browse2 = "";
	
		



//Download speed limit for files (HTTP only, FTP currently not supported). 0:Disable 1:Enable
$limit_download_speed = 0; //default = 0
$speed = 512; //Value in KB/s (KiloBytes per second). An example value: 128 (do not include "KB/s")

//File uploading (HTTP only, FTP currently not supported). ***ENABLE THIS FEATURE AT YOUR OWN RISK***. Please refer to the readme file (dirLIST_files/README.txt). For the maximum file upload size, please also refer to the readme file.
$file_uploads = 1; //default = 1;
$banned_file_types = array('.php', '.php3', '.php4', '.php5', '.htaccess', '.htpasswd', '.asp', '.aspx'); //add any other extensions you want banned (in lower-case)
$display_banned_files = 1; //Enable this to display a list of the file types banned on the main page. 0:Disable 1:Enable

//Files and/or folders to exclude from listing. dirLIST related files and folders are automatically excluded.
$exclude = array('.','..','.ftpquota','.htaccess', '.htpasswd', 'dirLIST_files');

//Files to exclude based on extension (eg: '.jpg' or '.PHP') and whether to be case sensitive. 0:Disable 1:Enable 
$exclude_ext = array('.something');
$case_sensative_ext = 0; //default = 0

//Image types to show thumbnails for (only types allowed are: .jpg .jpeg .png .gif) [Works best with HTTP listing]
//$thumb_types = array('.jpg', '.jpeg', '.png', '.gif');

//= = = = = = = = = = = = = = = = = = = = = = = = = =
//A  P  P  E  A  R  A  N  C  E   S  E  C  T  I  O  N
//= = = = = = = = = = = = = = = = = = = = = = = = = =

//Color schemes and whether to make it user selectable 0:Disable 1:Enable. 
$color_scheme_code = 0; //0:Blue 1:Red/Pink 2:Green 3:Yellow 4:Brown 5:Gray/Black
$color_scheme_user_selectable = 1; //default = 1

//Default view mode: thumbnails or list. 0:Thumbnails 1:List
$view_mode = 0; //default = 0
$view_mode_user_selectable = 1; // 0:No 1:Yes

//Display thumbnails of supported images? 0:Disable 1:Enable (please note that this feature may not work well with FTP)
$display_image_thumbs = 1;

//Enable content viewers? [HTTP LISTING ONLY]
$enable_gallery = 1; //When image file(s) are detected in the listed directory, a link is displayed to open the gallery
$enable_media_player = 1; //When mp3 file(s) are detected in the listed directory, a link is displayed to open the music player

//Language/Localisation settings. Set to a value of 0 for English, 1 for French, 2 for German and 3 for Spanish
$default_language = 0; //0:English, 1:French, 2:German, 3:Spanish
$language_user_selectable = 1; //Allow users to change the display language? 0:No, 1:Yes

//Statistics/legend/load time. 1:Enable 0:Disable
$statistics = 1; //default = 1
$legend = 1; //default = 1
$load_time = 1; //default = 1

//File icons. 0: Disabled 1:Enabled [List view only]
$file_icons = 1; //default = 1

//Sorting method. 0:By name 1:By size 2:By Date
$sort_by = 0; //default = 0
$sort_order = 0; //0:Ascending 1:Descending

//Hide file extensions from being displayed. 0:Disabled 1:Enabled
$hide_file_ext = 0; //default = 0

//Folder sizes. Disabling this will greatly improve performance if there are several hundred folders/files. However, size of folders wont show. Also note that if the listing mode is FTP, enabling folder size will very likely cause a script timeout. 1:Enable 0:Disable
$show_folder_size_http = 1; //default = 1
$show_folder_size_ftp = 0; //default = 0

//Table formatting (values in pixels)
$width_of_files_column = "450"; //default = 450
$width_of_sizes_column = "100"; //default = 100
$width_of_dates_column = "125"; //default = 125

?>