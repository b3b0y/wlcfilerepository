<?php
	session_start();

	if($_GET['Cancel'] == 'Cancel')
	{
		unset($_SESSION['genpass']);
	}
	else
	{
	
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $cpass = array(); //remember to declare $pass as an array
		$cuname = array();
	    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache]
		
		
		for($c = 0; $c < 1; $c++)
		{
			//password
			for ($i = 0; $i < 8; $i++) {
				$n = rand(0, $alphaLength);
				
				$cpass[$i] = $alphabet[$n];
			}	
			
			$pass[] = implode($cpass);
		}
		
		
		
		for($a = 0; $a < count($pass); $a++)
		{
			$_SESSION['genpass'] = $pass[$a]; //turn the array into a string
			
		}
	}
	
	header("Location: ../Admin.php?AddStu=Add")

?>