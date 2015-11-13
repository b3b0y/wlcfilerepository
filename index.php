<?php date_default_timezone_set("Asia/Hong_kong");


include_once("php/config.php");
include("php/php_file_tree.php");
require("dirLIST_files/config.php");
require("dirLIST_files/functions.php");


error_reporting(0);
set_time_limit(0);


	 $url_folder = basename(base64_decode(trim($_GET['folder'])));

	if(!empty($_GET['folder']))
	{
		
		$result1 = mysql_query("SELECT * FROM fr_path  WHERE Folder_Name = '".$url_folder."'");
		if(mysql_num_rows($result1) > 0)
		{
			$row1 = mysql_fetch_array($result1);

			 $dir_to_browse2 .= $row1['pathName']."/";
		}
		else
		{

			$result1 = mysql_query("SELECT * FROM fr_ins_subject  WHERE Subject = '".$url_folder."'");
			if(mysql_num_rows($result1) > 0)
			{
				$row1 = mysql_fetch_array($result1);
				
				 $dir_to_browse2 .= $row1['SubPath']."/";
			}
			else
			{
				$result1 = mysql_query("SELECT * FROM  fr_stud_subject  WHERE Folder_Name = '".$url_folder."'");
				if(mysql_num_rows($result1) > 0)
				{
					$row1 = mysql_fetch_array($result1);

					 $dir_to_browse2 .= $row1['SubPath']."/";
				}
			}
		}
	}


	//Load time
	if($load_time == 1)
		$start_time = array_sum(explode(" ",microtime()));

	//Set the view mode: thumbnails or list
	if(isset($_SESSION['view_mode_session']))
		$view_mode = $_SESSION['view_mode_session'];
		

	$local_text = set_local_text($default_language);
	$lang_id = $default_language;

	include("php/php.php");

	$name = mysql_query("SELECT * FROM fr_user  WHERE UserName = '".$_SESSION['user']."'");
	$array = mysql_fetch_array($name);

	if($array['UserLvl'] > 1)
	{
		$lvl = mysql_query("SELECT sta.*,us.* FROM fr_staff as sta, fr_user as us  WHERE (sta.UserName = us.UserName) AND sta.UserName = '".$_SESSION['user']."'");

		if(mysql_num_rows($lvl) > 0)
		{
			$row2 = mysql_fetch_array($lvl);

			$_SESSION['name'] = $row2['LastN']. ", ".  $row2['FirstN'];
		}
		else
		{

			$_SESSION['name'] = "ambot";
		}
	}
	else
	{
		$lvl = mysql_query("SELECT * FROM fr_stud  WHERE UserName = '".$_SESSION['user']."'");
		$row2 = mysql_fetch_array($lvl);

		$_SESSION['name'] = $row2['LName']. ", ".  $row2['FName'];
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>WLC Web-Base File Repository - <?PHP if(empty($url_folder)) echo "Index of: home/"; else echo "Index of: home/".$url_folder2.""; ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
	<!--

		<?PHP 
			echo 'body,td,th {font-family: Tahoma, Verdana;font-size: 10pt;}
			';
		?>

		.path_font {font-family: "Courier New", Courier, monospace;}
		.banned_font {font-size: 9px;}
		.error {border-top-width: 2px;border-bottom-width: 2px;border-top-style: solid;border-bottom-style: solid;border-top-color: #FF666A;border-bottom-color: #FF666A;}
		#color_scheme {cursor:pointer;}
		.option_style {font-family: Verdana, Tahoma;font-size: 11px;}
		#file_edit_box {position:absolute;width: 150px;display:none;}
		-->

	</style>

<?PHP 
	if($view_mode == 0) 
	{ //enable the javascript required for thumbnail view
?>

	<script type="text/javascript">
		var images_paths = [];
		var thumb_counter = 0;

		function display_thumbs() {
			more_thumbs = true;
			
			while(more_thumbs){
				thumb = document.getElementById('img_thumb_'+thumb_counter);
				if(document.getElementById('img_thumb_'+thumb_counter) != null){
					images_paths.push(thumb.getAttribute('link_att'));
					get_thumb(thumb_counter);
					thumb_counter++;
				}
				else
					more_thumbs = false;
			}
		}

		function get_thumb(id) 
		{
			var xhr;
			try	{ xhr = new XMLHttpRequest();}
			catch(e)
			{
				try
				{
					xhr = new ActiveXObject("Msxml12.XMLHTTP");
				}
				catch(e)
				{
					try
					{
						xhr = new ActiveXObject("Microsoft.XMLHTTP");
					}
					catch(e)
					{
						alert("Your browser does not support AJAX!");
						return false;
					}
				}
			}
			xhr.onreadystatechange = function()
			{
				if(xhr.readyState == 4)
				{
					document.getElementById('img_thumb_'+id).setAttribute('src', 'dirLIST_files/thumb_gen.php?image_path='+document.getElementById('img_thumb_'+id).getAttribute('link_att'));
				}
			}
			xhr.open("GET", "dirLIST_files/thumb_gen.php?image_path="+images_paths[id], true);
			xhr.send(null);
		}
	</script>
<?PHP 
	} 
?>
	<script type="text/javascript">
	var selected_item_type;
	var selected_item_id;
	var mouse_x;
	var mouse_y;

	var ms_ie = document.all?true:false;

	if (!ms_ie) document.captureEvents(Event.MOUSEMOVE)

	document.onmousemove = update_mouse_xy;

	function show_div(item_type, item_id)
	{
		selected_item_type = item_type;
		selected_item_id = item_id;
		
		x = mouse_x;
		y = mouse_y;
		
		//some browsers may return negative values
		if(x < 0) x = 0;
		if(y < 0) y = 0;
		
		document.getElementById('file_edit_box').style.display = 'block';
		document.getElementById('file_edit_box').style.left = x-8+'px';
		document.getElementById('file_edit_box').style.top = y-8+'px';
	}

	</script>


	<link href="css/style.css" type="text/css" rel="stylesheet" />
	<link href="css/File.css" type="text/css" rel="stylesheet" />
	<link href="css/div.css" type="text/css" rel="stylesheet" />
	<link href="css/FolderTree.css" type="text/css" rel="stylesheet"  media="screen">
	<link href="css/Menu.css" type="text/css" rel="stylesheet" />
	<link href="css/popup.css" type="text/css" rel="stylesheet">
	<link href="css/default.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="css/gridimage.css" rel="stylesheet" type="text/css" media="screen" />
	
	<script type="text/javascript" src="Javascript/sorttable.js"></script>
	<script type="text/javascript" src="Javascript/jQuery v1.7.js"></script>
	<script type="text/javascript" src="Javascript/menu.js"></script>
	<script type="text/javascript" src="Javascript/php_file_tree.js"></script>
	<script type="text/javascript" src="Javascript/Click.js"></script>
	

</head>


<body >
<!--<body onload="javascript:fg_hideform('fg_formContainer','fg_backgroundpopup');"> -->
	<aside id="menu">
	   <nav>
			<?php include("php/Menu.php") ?>
	   </nav>
	</aside>
	<section id="contenido">
		<?php include("php/header.php"); ?>
		<section>
			<div id="page" > 
				<div id="hd" class="clearfix">
					<div class=" twelve columns">
						<div id="ext-comp-1009-body" class="x-ribbon x-panel-body x-panel-body-default x-layout-fit x-panel-body-default x-docked-noborder-right x-docked-noborder-bottom x-docked-noborder-left" style="width: 100%; left: 0px;  height: 100px;">
							<div id="toolbar-1011" class="x-toolbar x-unselectable x-tabpanel-child x-toolbar-default x-box-layout-ct" style="border-width: 0pt; margin: 0pt; width: 100%;">
								<div id="toolbar-1011-innerCt" class="x-box-inner" style="width: 100%; height: 95px;">
									<div id="toolbar-1011-targetEl" class="x-box-target" style="width: 100%;">
										<div id="buttongroup-1037" class="x-btn-group x-box-item x-toolbar-item x-btn-group-default" style="margin: 0pt; right: auto; left: 0; top: 0px; height: 90px; width: 69px;">
											<div id="buttongroup-1037-body" class="x-btn-group-body x-btn-group-body-default x-box-layout-ct x-btn-group-body-default" style="left: 12px; top: 0px; height: 69px; width: 56px;">
												<div id="buttongroup-1037-innerCt" class="x-box-inner" style="width:80px; height: 69px;">
													<div id="buttongroup-1037-targetEl" class="x-box-target" style="width: 47px;">
														<a href="<?php echo basename($_SERVER['PHP_SELF']) ?>" class="x-btn  x-box-item x-btn-default-toolbar-large x-item-disabled x-btn-disabled" style="margin: 0pt; right: auto; left: 0px; top: 10px;"> 
															<span id="button-1033-btnWrap" class="x-btn-wrap x-btn-wrap-default-toolbar-large">
																<span id="button-1033-btnEl" class="x-btn-button x-btn-button-default-toolbar-large x-btn-text  x-btn-icon x-btn-icon-top x-btn-button-center">
																	<span id="button-1033-btnIconEl" class="x-btn-icon-el x-btn-icon-el-default-toolbar-large filemanagericons icon-copy32 center-large-icon ">
																		<img src="Images/Home.png" width="50">
																	</span>
																	<br>
																	<span id="button-1033-btnInnerEl" class="x-btn-inner x-btn-inner-default-toolbar-large">
																		
																	</span>
																</span>
															</span>
														</a>
													</div>
												</div>
											</div>
											<div id="buttongroup-1037" class="x-btn-group-header x-header x-docked x-unselectable x-btn-group-header-default x-horizontal x-btn-group-header-horizontal x-btn-group-header-default-horizontal x-bottom x-btn-group-header-bottom x-btn-group-header-default-bottom x-docked-bottom x-btn-group-header-docked-bottom x-btn-group-header-default-docked-bottom x-box-layout-ct" style="right: auto; left: 10px; top: 71px; width: 45px;">
												<div id="buttongroup-1037-innerCt" class="x-box-inner" style="width: 45px; height: 15px;">
													<div id="buttongroup-1037-targetEl" class="x-box-target" style="width: 45px;;">
														<div id="title-1082" class="x-title x-btn-group-header-title x-btn-group-header-title-default x-box-item x-title-default x-title-rotate-none x-title-align-center" style="right: auto; top: 0px; margin: 0pt; left: 0px; width: 45px;">
															<div id="title-1082-textEl" class="x-title-text x-title-text-default x-title-item">
																Home
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									<?php
									$result = mysql_query("SELECT * FROM fr_share_folder WHERE Folder_Name  = '".$url_folder."'") or die ("folder error");
									if(mysql_num_rows($result) > 0)
									{
											$result = mysql_query("SELECT * FROM fr_share_folder WHERE Folder_Name  = '".$url_folder."' AND Folder_Owner = '".$_SESSION['uid']."'") or die ("folder error");
											if(mysql_num_rows($result) > 0)
											{
												include_once('php/Button.php');
											}
											else
											{
											?>
												<div id="buttongroup-1037" class="x-btn-group x-box-item x-toolbar-item x-btn-group-default" style="margin: 0pt; right: auto; left: 60px; top: 0px; height: 90px; width: 115px;">
													<div id="buttongroup-1037-body" class="x-btn-group-body x-btn-group-body-default x-box-layout-ct x-btn-group-body-default" style="left: 13px; top: 2px; height: 69px; width: 108px;">
														<div id="buttongroup-1037-innerCt" class="x-box-inner" style="width: 106px; height: 100px;">
															<div id="buttongroup-1037-targetEl" class="x-box-target" style="width: 106px;">
																<span id="button-1033-btnWrap" class="x-btn-wrap x-btn-wrap-default-toolbar-large">
																	<span id="button-1033-btnEl" class="x-btn-button x-btn-button-default-toolbar-large x-btn-text  x-btn-icon x-btn-icon-top x-btn-button-center">
																		<span id="button-1033-btnIconEl" class="x-btn-icon-el x-btn-icon-el-default-toolbar-large filemanagericons icon-copy32 center-large-icon ">
																			<input  type="image" onclick="download();" src="Images/Down.png" width="40px" height="40px" alt="download" name="download" id="download" style="cursor:pointer" > 
																		</span>
																		<br>
																		<span id="button-1033-btnInnerEl" class="x-btn-inner x-btn-inner-default-toolbar-large">
																			Download
																		</span>
																	</span>
																</span>
															</div>
														</div>
													</div>
													<div id="buttongroup-1032_header" class="x-btn-group-header x-header x-docked x-unselectable x-btn-group-header-default x-horizontal x-btn-group-header-horizontal x-btn-group-header-default-horizontal x-bottom x-btn-group-header-bottom x-btn-group-header-default-bottom x-docked-bottom x-btn-group-header-docked-bottom x-btn-group-header-default-docked-bottom x-box-layout-ct" style="right: auto; left: 2px; top: 71px; width: 131px;">
														<div id="buttongroup-1032_header-innerCt" class="x-box-inner" style="width: 131px; height: 15px;">
															<div id="buttongroup-1032-targetEl" class="x-box-target" style="width: 131px;">
																<div id="title-1082" class="x-title x-btn-group-header-title x-btn-group-header-title-default x-box-item x-title-default x-title-rotate-none x-title-align-center" style="right: auto; top: 0px; margin: 0pt; left: 0px; width: 131px;">
																	<div id="title-1082-textEl" class="x-title-text x-title-text-default x-title-item">
																		Transfer
																	</div>
																</div>
															</div>
														</div>
													</div>
												</div>
											<?php		
											}
									}
									else
									{
										
											include_once('php/Button.php');
										
									}
									?>
									</div>
								</div>
							</div>
						</div>
					</div>  <!-- hd-slot -->
				<div class="clearfix" id="index">
						<div class="twelve columns" id="index2">
						
								
							
						</div>
				</div>
				<div id="bd" class="clearfix">
					<div class="row">
						<div class="twelve columns"> 
							<div class="clearfix">
								<!--<div class="span-5" id="left-slot">
									<div class="row">
										<div class=" twelve columns">
											<p style="margin:5px;padding:3px;border-bottom:1px solid #CCC;width:235px;font-size:14px;"> <img src='Images/directory.png'>	<?php echo $_SESSION['name']; ?> Folder(s) </p>
										</div>
										<div class="twelve columns">
											<div class="clearfix">
												<?php

													echo php_file_tree($_SESSION['path'], "[link]");
												?>
											</div>
										</div>
									</div>
								</div> <!-- left-slot -->
								<div class="span-19" id="content-slot">
									<div id="search-results">
										<div class="clearfix">
											<!-- Output basic HTML code -done -->
											<?PHP
												require('FileManagement/OwnerFile.php');
											?>		
										</div>
									</div>	
								</div> <!-- content-slot -->
							</div>
						<!--	<div  id="ft" class="clearfix ">
								<div id="ft-wrap">
									<div class=" row">
										<div class=" twelve columns">
										Footer Slot
										</div>
									</div>
								</div>
							</div><!-- ft-slot -->
						</div>
					</div>
				</div> <!-- bd-slot -->	
			</div>
		</section>
	</section>
	<?PHP
require('FileManagement/AddFolder.php');
require('FileManagement/addSubject.php');
require('FileManagement/StudSubject.php');
require('FileManagement/UploadForm.php');

?>

<div id="file_edit_box" onmouseout="mouse_out_handler(event);">
  <img src="dirLIST_files/edit_files/rename.png" alt="rename" name="rename" width="32" height="32" id="rename" style="cursor:pointer" />
</div>
<script type="text/javascript">
var js_files_and_folders_base64 = [
	[<?PHP 
	 foreach($folders_sorted as $key => $val)
	 	$folders_string_base64 .= '\''.base64_encode($folders['link'][$key]).'\',';
	echo substr($folders_string_base64, 0, -1);
	 ?>],
	[<?PHP 
	 foreach($files_sorted as $key => $val)
	 	$files_string_base64 .= '\''.base64_encode($files['link'][$key]).'\',';
	echo substr($files_string_base64, 0, -1);
	 ?>]
];

var js_files_and_folders = [
	[<?PHP 
	 foreach($folders_sorted as $key => $val)
	 	$folders_string .= '\''.basename($folders['link'][$key]).'\',';
	echo substr($folders_string, 0, -1);
	 ?>],
	[<?PHP 
	 foreach($files_sorted as $key => $val)
	 	$files_string .= '\''.basename($folders['link'][$key]).'\',';
	echo substr($files_string, 0, -1);
	 ?>]
];

function delete_item()
{
	item_name = js_files_and_folders[selected_item_type][selected_item_id];
	item_name_base64 = js_files_and_folders_base64[selected_item_type][selected_item_id];

	if(confirm("********<?PHP echo $local_text['warning']; ?>!********\n\n<?PHP echo $local_text['no_go_back']; ?>\n\n"+'<?PHP echo $local_text['sure_to_del']; ?> ` '+item_name+' ` ?')) window.location = 'dirLIST_files/edit_files/delete.php?folder=<?PHP echo base64_decode($_GET['folder']); ?>&item_name='+item_name_base64;

}

function share_folder()
{
	item_name = js_files_and_folders[selected_item_type][selected_item_id];
	item_name_base64 = js_files_and_folders_base64[selected_item_type][selected_item_id];

	if(confirm("Are you sure you want to Share this folder"+' ` '+item_name+' ` ?')) window.location = 'FileManagement/shared.php?folder=<?PHP echo base64_decode($_GET['folder']); ?>&item_name='+item_name_base64;

}

function ren()
{
	item_name_base64 = js_files_and_folders_base64[selected_item_type][selected_item_id];
	window.open('dirLIST_files/edit_files/rename.php?folder=<?PHP echo base64_decode($_GET['folder']); ?>&item_name='+item_name_base64, null, 'scrollbars = 0, status = 1, height = 135, width = 470, resizable = 1, location = 0');
}

function download()
{
	item_name_base64 = js_files_and_folders_base64[selected_item_type][selected_item_id];
	location.href='dirLIST_files/download.php?folder=<?PHP echo $_GET['folder']; ?>&item_name='+item_name_base64;
}					

</script>

</body>
</html>

