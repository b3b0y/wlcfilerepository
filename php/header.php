

<style type="text/css">

a:hover {
	color: black;
	text-decoration: none;
}

#menu1 
{
	position: relative;
	margin-right:50px;
	float:right;
	padding-top:5px;
}

#menu1 a {
	display: block;
	width: 200px;
}

#menu1 ul {
	list-style-type: none;
}

#menu1 li {
	float: left;
	position: relative;
	text-align: center;
}

#menu1 ul.sub-menu1 {
	position: absolute;
	left: -10px;
	z-index: 90;
	display:none;
}

#menu1 ul.sub-menu1 li {
	text-align: left;
}

#menu1 li:hover ul.sub-menu1 {
	display: block;
}
a
{	text-decoration:none; }
	

.egg{
	position:relative;
	box-shadow: 0 3px 8px rgba(0, 0, 0, 0.25);
	background-color:#fff;
	border-radius: 3px 3px 3px 3px;
	border: 1px solid rgba(100, 100, 100, 0.4);
	z-index: 9999;
}
.egg_Body{border-top:1px solid #D1D8E7;color:#808080;}
.egg_Message{font-size:13px !important;font-weight:normal;overflow:hidden}

.comment_ui
{
border-bottom:1px solid #e5eaf1;clear:left;float:none;overflow:hidden;padding:6px 4px 3px 6px;width:431px; cursor:pointer;
}
.comment_ui:hover{
background-color: #F7F7F7;
}
.dddd
{
	background-color:#f2f2f2;
	border-bottom:1px solid #e5eaf1;
	clear:left;
	float:none;
	overflow:hidden;
	margin-bottom:2px;
	padding:6px 4px 3px 6px;
	width:431px; 
}
.comment_text{padding:2px 0 4px; color:#333333}
.comment_actual_text{display:inline;padding-left:.4em}

#mes{
	padding: 0px 3px;
	border-radius: 2px 2px 2px 2px;
	background-color: rgb(240, 61, 37);
	font-size: 9px;
	font-weight: bold;
	color: #fff;
	position: absolute;
	top: 5px;
	left: 103px;
}
.toppointer{
	background-image:url(Images/top.png);
    background-position: -82px 0;
    background-repeat: no-repeat;
    height: 11px;
    position: absolute;
    top: -10px;
    width: 20px;
	right: 130px;
}
.clean { display:none}




}

</style>
<header>
	    		
       	<div > 
       		<img class="menulist" src="Images/menu-alt-32.png"/> 
       		<h1> <a href="index.php"> WLC WEB-BASED FILE REPOSITORY </a></h1>
       	<div id="menu1">
       	<ul>
			<li>
	       		<a href="#">
		       		<img src="Images/Notification.png" width="30px" /> 	
		       		<?php 
		       			$result = mysql_query("SELECT stud.*,sub.*,studsub.*,fr_subject.* FROM fr_ins_subject as sub,fr_stud as stud,fr_stud_subject as studsub , fr_subject WHERE fr_subject.SubCode = sub.Subject AND studsub.subID = sub.ID AND studsub.studID = stud.uid AND sub.uid = '".$_SESSION['uid']."' AND studsub.status='DISAPPROVED'");
		       			$comment_count=mysql_num_rows($result);
		       			if($comment_count!=0)
						{
		       		?>
		       		<span id="mes"><?php echo  $comment_count ?></span>
		       			<?php
		       			}
		       			?>
	       		</a>
	       		<ul class="sub-menu1">
	       			<?php
					if($comment_count!=0)
					{
					?>	
		       			<li class="egg">
		       			<div class="bbbbbbb" >
							<div style="background-color: #F7F7F7; border-bottom-left-radius: 3px; border-bottom-right-radius: 3px; position: relative; z-index: 100; padding:8px; cursor:pointer;">
							<a href='Admin.php?approval=Subject' class="view_comments" id="<?php echo $id; ?>">View all <?php echo $comment_count; ?> enrolled student</a></div>
						</div>
		       			</li>
	       			<?php
					}
					?>
	       		</ul>
       		</li>
		</ul>
     	</div>
       	

       	<div > 
       	
</header>