<?PHP date_default_timezone_set("Asia/Hong_kong");


if(empty($_GET['item_name']))
	die('item_name empty');

include_once("../php/config.php");
require('../dirLIST_files/config.php');
require('../dirLIST_files/functions.php');

$folder = basename($_GET['folder']);
$file_name = basename(base64_decode($_GET['item_name']));

$result = mysql_query("SELECT * FROM  fr_ins_subject WHERE uid = '".$_SESSION['uid']."' AND Subject = '".$folder."'");
if(mysql_num_rows($result) > 0)
{
	$date = date ("y/m/d");
	$time = date ("H:i:s");

	$row = mysql_fetch_array($result);

	$result = mysql_query("SELECT * FROM  fr_stud_subject WHERE subID = '".$row['ID']."'");
	if(mysql_num_rows($result) > 0)
	{
		while ($row1 = mysql_fetch_array($result)) 
		{

				mysql_query("INSERT INTO fr_share_folder(studID,Sub_Name,Folder_Name,subID,Folder_Owner,Date_Created,Time_Created) VALUES('".$row1['studID']."','".$folder."-".$file_name."','".$file_name."','".$row['ID']."','".$_SESSION['uid']."','".$date."','".$time."') ON DUPLICATE KEY UPDATE studID = '".$row1['studID']."',Sub_Name = '".$folder."-".$file_name."',Folder_Name = '".$file_name."',subID = '".$row['ID']."',Folder_Owner = '".$_SESSION['uid']."'") or die ("wew". mysql_error());
		}
	}
}

header("Location: ../index.php?folder=".basename(base64_encode($_GET['folder'])));
exit;
?>