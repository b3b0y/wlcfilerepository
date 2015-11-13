<?php
session_start();
include_once("php/config.php");

?>

<html>
<head>
<title> 
</title>   
<style type="text/css">
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
  width:200px;
}

.password_strength {
    display:block;
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
<link href="css/style.css" type="text/css" rel="stylesheet" /> 
<script src="Javascript/jQuery v1.11.0.js" type="text/javascript" language="javascript"></script>
<script src="Javascript/Req.js" type="text/javascript" language="javascript" ></script>
<script language="javascript" src="Javascript/chkUserPass.js" type="text/javascript"></script>

</head>
<body style="background-image: ;">
<div  class="form" >
    <form id="contactform" method="post" action="php/chckReq.php?Check=Y">   
            <p class="contact">Legend:<font style="color:red;" size="5px">  * </font> - Required field </p>
            
            <?php
              $result = mysql_query("SELECT * FROM fr_stud WHERE ControlNo = '".$_SESSION['user']."'");

              $row = mysql_fetch_array($result);
            ?>

             <p class="contact"><label for="Cont"><center>Welcome <b><? echo $row['FName'] .' '.$row['Mname'] .' '. $row['LName']; ?></b> you are required to change your Username and Password</center></label></p> 
  
            <p class="contact"><label for="uname">New Username <font style="color:red"> * </font></label></p> 
            <input id="username" name="uname" placeholder="Username" required="" tabindex="1" type="text" value="" Required>
            <div class="username_avail_result" id="username_avail_result"></div>

            <p class="contact"><label for="password">Enter New password <font style="color:red"> * </font></label></p> 
            <input type="password" id="password" name="Npass" placeholder="New password" tabindex="2" required=""> 
            <div class="password_strength" id="password_strength"></div>

            <p class="contact"><label for="repassword">Confirm your New password  <font style="color:red"> * </font></label></p> 
            <input type="password" id="repassword" name="Conpass" placeholder="Confirm Password" tabindex="3" required=""> 
            <div class="cpassword_strength" id="repassword_strength"></div>

            <p class="contact" style="border: 1px solid gray;Width:400px;"></p> 
           

            <input class="buttom" name="submit" id="submit" tabindex="4" value="CONTINUE" type="submit"> 
            <a href='php/chckReq.php?Cancel=X'><input class="buttom" tabindex="" type="button" value="CANCEL"> </a>
    </form> 
</div>  

</body>