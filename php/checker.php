<?php
include 'config.php'; // include the library for database connection
if(isset($_POST['action']) && $_POST['action'] == 'username_availability')
{ 
	// Check for the username posted
	$username 		= htmlentities($_POST['username']); 
	// Get the username values
	$check_query	= mysql_query('SELECT * FROM fr_user WHERE UserName = "'.$username.'" '); 
	//$check_query2	= mysql_query('SELECT * FROM fr_user WHERE UserName = "'.$username.'" ');
	// Check the database
	echo mysql_num_rows($check_query); 
	//echo mysql_num_rows($check_query2); 
	// echo the num or rows 0 or greater than 0
}
else if(isset($_POST['action1']) && $_POST['action1'] == 'ControlNo_availability')
{ 
	// Check for the username posted
	$username 		= htmlentities($_POST['ControlNo']); 
	// Get the username values
	$check_query	= mysql_query('SELECT * FROM fr_stud WHERE 	ControlNo = "'.$username.'" '); 
	//$check_query2	= mysql_query('SELECT * FROM fr_user WHERE UserName = "'.$username.'" ');
	// Check the database
	echo mysql_num_rows($check_query); 
	//echo mysql_num_rows($check_query2); 
	// echo the num or rows 0 or greater than 0
}

?>