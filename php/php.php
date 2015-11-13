<?php

$user = "";

if(!isset($_SESSION['login'])) 
{
        header("Location: Login.php");
} 

if($_SESSION['login'] == "ADMIN")
{
	$user = "<a href='Admin.php'>Dashboard</a>";
	$empty = 1;
}
else if($_SESSION['login'] == "DEAN")
{
	$user = "<a href='Admin.php'>Dashboard</a>";
	
	$empty = 1;
}
else if($_SESSION['login'] == "Instructor")
{
	$user = "<a href='Admin.php'>Dashboard</a>";
	$empty = 1;
}
else if($_SESSION['login'] == "Student")
{
	$user = "<a href='Dashboard.php?Report=Repo'>Reports</a>";
	$user2 = "<a href='Admin.php?enroll=Subject'>Enroll Subject</a>";
	$user3 = "<a href='Admin.php?studsub=Subject'>My Subject</a>";
	$empty = 1;
}

?>