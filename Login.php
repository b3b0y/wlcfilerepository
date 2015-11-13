<?php
session_start();
include_once("php/config.php");

if(isset($_SESSION['login'])) 
{
        header("Location: index.php");
} 
	
?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>WLC WEB-BASED FILE REPOSITORY</title>
  <link rel="stylesheet" href="css/Login.css">
   <script src="Javascript/prefixfree.min.js"></script>
  <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>
  <section class="container">
    <div class="login">
      <h1>Login to Web File Repository</h1>
      <form method="post" action="php/chkpass.php">
		<table>
			<tr>
				<td><span>Username: &nbsp;</span></td>
				<td><input type="text" name="user" value="" placeholder="Username" Required></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
			</tr>
			<tr>
				<td>Password: </td>
				<td><input type="password" name="pass" value="" placeholder="Password" Required></td>
			</tr>
		</table>
        <p class="submit"><input type="submit" name="commit" value="Login"></p>
      </form>
    </div>

    <div class="login-help">
      <p>Forgot your password? <a href="index.php">Click here to reset it</a>.</p>
    </div>
  </section>

  
</body>
</html>