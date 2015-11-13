<?php date_default_timezone_set("Asia/Hong_Kong");
session_start();
include_once("php/config.php");

	include("php/php.php");

	if(isset($_POST['settings']) && $_POST['settings'] == "Save changes")
	{


		if(isset($_POST['active'])) //activate
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				mysql_query("UPDATE fr_user SET  activate = '".$_POST['active']."'  WHERE UserName='".$_SESSION['uedit'][$i]."'");
			}
		}
		else
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				mysql_query("UPDATE fr_user SET  activate = '0'  WHERE UserName='".$_SESSION['uedit'][$i]."'");
			}
		}

		if(isset($_POST['chnge'])) //change password
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  change_pass = '".$_POST['chnge']."'  WHERE uid ='".$row['UserID']."'");
			}
		}
		else
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  change_pass = '0'  WHERE uid ='".$row['UserID']."'");
			}
		}

		if(isset($_POST['upload'])) //Upload file
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  upload = '".$_POST['upload']."'  WHERE uid ='".$row['UserID']."'");
			}
		}
		else
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  upload = '0'  WHERE uid ='".$row['UserID']."'");
			}
		}

		if(isset($_POST['download'])) //download file
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  download = '".$_POST['download']."'  WHERE uid ='".$row['UserID']."'");
			}
		}
		else
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  download = '0'  WHERE uid ='".$row['UserID']."'");
			}
		}

		if(isset($_POST['zip'])) //zip file
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  download_folders = '".$_POST['zip']."'  WHERE uid ='".$row['UserID']."'");
			}
		}
		else
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  download_folders = '0'  WHERE uid ='".$row['UserID']."'");
			}
		}

		if(isset($_POST['create'])) //zip file
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  create_folders = '".$_POST['create']."'  WHERE uid ='".$row['UserID']."'");
			}
		}
		else
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  create_folders = '0'  WHERE uid ='".$row['UserID']."'");
			}
		}

		if(isset($_POST['share'])) //share file
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  share = '".$_POST['share']."'  WHERE uid ='".$row['UserID']."'");
			}
		}
		else
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET  share = '0'  WHERE uid ='".$row['UserID']."'");
			}
		}
		
		if(isset($_POST['delete'])) //delete file
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET delete_F = '".$_POST['delete']."'  WHERE uid ='".$row['UserID']."'");
			}
		}
		else
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET delete_F = '0'  WHERE uid ='".$row['UserID']."'");
			}
		}

		if(isset($_POST['rename_F'])) //rename file
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET rename_F = '".$_POST['rename_F']."'  WHERE uid ='".$row['UserID']."'");
			}
		}
		else
		{
			$rowCount = count($_SESSION['uedit']);
			
			for($i=0; $i<$rowCount; $i++)
			{

				$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['uedit'][$i]."'");

				$row = mysql_fetch_array($result);
				mysql_query("UPDATE fr_user_permissions SET rename_F = '0'  WHERE uid ='".$row['UserID']."'");
			}
		}
	}

	if(isset($_POST['login']) && $_POST['login'] == "Save changes")
	{
		$rowCount = count($_SESSION['uedit']);
		
		for($i=0; $i<$rowCount; $i++)
		{
			mysql_query("UPDATE fr_user SET UserName = '".$_POST['uname']."', UserPass = '".$_POST['pass']."'  WHERE UserName='".$_SESSION['uedit'][$i]."'");
			$_SESSION['uedit'][$i] = $_POST['uname'];
		}


	}

		
?>

<html>
<head>
	<title>WLC Web-Base File Repository</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/style.css" type="text/css" rel="stylesheet" />
	<link href="css/div.css" type="text/css" rel="stylesheet" />
	<link href="css/Menu.css" type="text/css" rel="stylesheet" />

	<script type="text/javascript" src="Javascript/jquery-1.9.1.js"></script>
	<script language="javascript" src="Javascript/menu.js" type="text/javascript"></script>
	<script language="javascript" src="Javascript/users.js" type="text/javascript"></script>
	<script language="javascript" src="Javascript/ShowHide.js" type="text/javascript"></script>
	<script language="javascript" src="Javascript/chkUserPass.js" type="text/javascript"></script>
<style>

.success{
  color:#009900;
  font-weight:bold;
}
.error{
  color:#F33C21;
  font-weight:bold;
}
.talign_right{
  text-align:right;
}
.username_avail_result{
  display:block;
  width:180px;
}
.password_strength {
  display:block;
  width:180px;
  padding:3px;
  text-align:center;
  color:#333;
  font-size:16px;
  backface-visibility:#FFF;
  font-weight:bold;
}
/* Password strength indicator classes weak, normal, strong, verystrong*/
.password_strength.weak{
  width:80px;
  background:#e84c3d;
}
.password_strength.normal{
  width:120px;
  background:#f1c40f;
}
.password_strength.strong{
  width:180px;
  background:#27ae61;
}
.password_strength.verystrong{
  width:280px;
  background:#2dcc70;
  color:#FFF;
}

.cpassword_strength {
  display:block;
  width:180px;
  color:#e84c3d;
  backface-visibility:#FFF;
  font-weight:bold;
}
.cpassword_strength.match{
  color:#2dcc70;
}

</style>

</head>
<body >
	<aside id="menu">
	   <nav>
			<?php include("php/Menu.php") ?>
	   </nav>
	</aside>
	<section id="contenido">
		<header>
	    		<img class="menulist" src="Images/menu-alt-32.png"/>
		       	<h1> <a href="index.php"> WLC WEB-BASED FILE REPOSITORY </a></h1>     
		</header>
		<section>
			<div id="page"> 
				<div id="bd" class="clearfix">
					<div class="row"  id="back">
						<div class="twelve columns"> 
							<div id='cssmenu'>
								<ul>
								    <li><a href='Admin.php?Report=Repo'><span>Report Management</span></a></li>
								    <li><a href='#'><span>Account Management</span></a>
										<ul>
											<li>
										   		<a href='Admin.php?ViewSta=View'><span>FACULTY</span></a> 
										   	</li>
										    <li>
										    	<a href='Admin.php?ViewStu=View'><span>STUDENT</span></a>
										   </li>
										</ul>
								    </li>
								    <li><a href='#'><span>System Setting</span></a></li>
								    <li class='last'><a href='#'><span>[Title Here]</span></a></li>
								</ul>
							</div>
							<div id="cont" class="span-19">
								<div class="row"  >
									<div class="twelve columns">
										<div style="padding:10px;"> 
										<?php 
											if(isset($_POST["users"]))
											{
												$_SESSION['uedit'] = $_POST["users"];
											}
											
											$rowCount = count($_SESSION['uedit']);
											
											
											for($i=0; $i<$rowCount; $i++) 
											{
												$result = mysql_query("SELECT fr_user.*,fr_path.*,fr_stud.*,fr_user_permissions.* FROM fr_user,fr_path,fr_stud,fr_user_permissions WHERE fr_user.UserID = fr_user_permissions.uid   AND fr_user.UserID = fr_stud.uid AND fr_user.UserName ='".$_SESSION['uedit'][$i]."'");
											
												$row[$i] = mysql_fetch_array($result);

										 ?>
											<div id="top-slot">
												<h1> Edit User "<?php echo $_SESSION['uedit'][$i]; ?>"</h1>
											</div>
												
											<div class="span-10 form1">
													<fieldset>
														<legend>User info </legend>
														<table>
															<tr>
																<td><label>Control No.:</label></td>
																<td><input type="text" value='<?php echo $row[$i]["ControlNo"] ?>'  readonly=""></td>
															</tr>
															<tr>
																<td><label>Name:</label></td>
																<td><input type="text" value="<?php echo $row[$i]["FName"].' '.$row[$i]["Mname"].' '.$row[$i]["LName"] ?>"  readonly=""></td>
															</tr>
															<tr>
																<td><label>Course/Year:</label></td>
																<td><input type="text" value="<?php echo $row[$i]["Course"].' - '.$row[$i]["Year"] ?>" readonly=""></td>
															</tr>
															<tr>
																<td></td>
																<td>&nbsp</td>
															</tr>
															<tr>
																<td></td>
																<td>
																	<a href='javascript:fg_popup_form("fg_formFaculty","fg_form_InnerFaculty","fg_backgroundFaculty");'>
																		<input type="button" name="Update" id="btnSubmit"  value="Edit" class="buttom" >
																	</a> 
																</td>
															</tr>
														</table>
													</fieldset>
													<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
														<fieldset>
															<legend>Login info </legend>

															<table>
																<tr>
																	<td><label>Username:</label></td>
																	<td><input id="username" type="text" name="uname" value='<?php echo $row[$i]["UserName"] ?>' required></td>
																	<td><div class="username_avail_result" id="username_avail_result"></div></td>
																</tr>
																<tr>
																	<td><label>Password:</label></td>
																	<td><input id="password" type="password" name="pass" value='<?php echo $row[$i]["UserPass"] ?>' required></td>
																	<td><div class="password_strength" id="password_strength"></div></td>
																</tr>
																<tr>
																	<td></td>
																	<td>&nbsp</td>
																</tr>
																<tr>
																	<td></td>
																	<td>
																		<input type="submit" name="login" value="Save changes" class="buttom">
																	</td>
																</tr>
															</table>
															
														</fieldset>
													</form>
													<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?> ">
														<fieldset>
															<legend>Permissions</legend>

															<table>
																<tr>
																	<td><label>Folder Path:</label></td>
																	<td><input type="text" id="folder" value='<?php echo $row[$i]["pathName"] ?>' readonly=""></td>
																</tr>
																<tr>
																	<td></td>
																	<td><input type="checkbox" name="active" value='1' <?php if(isset($row[$i]["activate"]) && $row[$i]["activate"] == 1) echo "checked" ?> >  Activated Account</td>
																</tr>
																<tr>
																	<td></td>
																	<td><input type="checkbox" name="upload" value='1' <?php if(isset($row[$i]["upload"]) && $row[$i]["upload"] == 1) echo "checked" ?>> User can Upload files</td>
																</tr>
																<tr>
																	<td></td>
																	<td><input type="checkbox" name="download" value='1' <?php if(isset($row[$i]["download"]) &&$row[$i]["download"] == 1) echo "checked" ?>> User can Download files</td>
																</tr>
																<tr>
																	<td></td>
																	<td><input type="checkbox" name="create" value='1' <?php if(isset($row[$i]["create_folders"]) &&$row[$i]["create_folders"] == 1) echo "checked" ?>> User can Create folders</td>
																</tr>
																<tr>
																	<td></td>
																	<td><input type="checkbox" name="zip" value='1' <?php if(isset($row[$i]["download_folders"]) &&$row[$i]["download_folders"] == 1) echo "checked" ?>> User can Zip and Download folders</td>
																</tr>
																<tr>
																	<td></td>
																	<td><input type="checkbox" name="share" value='1' <?php if(isset($row[$i]["share"]) && $row[$i]["share"] == 1) echo "checked" ?>> User can share folders</td>
																</tr>
																<tr>
																	<td></td>
																	<td><input type="checkbox" name="chnge" value='1' <?php if(isset($row[$i]["change_pass"]) && $row[$i]["change_pass"] == 1) echo "checked" ?>> User can change the password</td>
																</tr>
																<tr>
																	<td></td>
																	<td><input type="checkbox" name="rename_F" value='1' <?php if(isset($row[$i]["rename_F"]) && $row[$i]["rename_F"] == 1) echo "checked" ?>> User cannot rename</td>
																</tr>
																<tr>
																	<td></td>
																	<td><input type="checkbox" name="delete" value='1' <?php if(isset($row[$i]["delete_F"]) && $row[$i]["delete_F"] == 1) echo "checked" ?>> User cannot delete</td>
																</tr>
																<tr>
																	<td></td>
																	<td>&nbsp</td>
																</tr>
																<tr>
																	<td></td>
																	<td>
																		<input type="submit" name="settings" value="Save changes" class="buttom">
																	</td>
																</tr>
															</table>
														</fieldset>
													</form>
											</div>
											<?php
											}
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- bd-slot -->	
			</div>
		</section>
	</section>

</body>
</html>