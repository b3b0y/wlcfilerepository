<?php
session_start();
include_once("php/config.php");

	include("php/php.php");


	$ctr="";
?>

<html>
<head>
	<title>WLC Web-Base File Repository</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link href="css/style.css" type="text/css" rel="stylesheet" />
	<link href="css/div.css" type="text/css" rel="stylesheet" />
	<link href="css/Menu.css" type="text/css" rel="stylesheet" />
	<link href="css/popup.css" type="text/css" rel="stylesheet">
	<link  href="css/pagination.css" rel="stylesheet" media="screen" />

	
	<script src="Javascript/sorttable.js" type="text/javascript"></script>
	<script type="text/javascript" src="Javascript/jquery-1.9.1.js"></script>
	<script language="javascript" src="Javascript/menu.js" type="text/javascript"></script>
	<script language="javascript" src="Javascript/users.js" type="text/javascript"></script>
	<script language="javascript" src="Javascript/ShowHide.js" type="text/javascript"></script>
	<script language="javascript" src="Javascript/chkUserPass.js" type="text/javascript"></script>
	<script type="text/javascript" src="Javascript/html-table-search.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('table.search-table').tableSearch();
        });
    </script>
<style>
table {
    *border-collapse: collapse; /* IE7 and lower */
    border-spacing: 0;
    width: 100%;    
}

.bordered {
    border: solid #ccc 1px;
    -moz-border-radius: 6px;
    -webkit-border-radius: 6px;
    border-radius: 6px;
    -webkit-box-shadow: 0 1px 1px #ccc; 
    -moz-box-shadow: 0 1px 1px #ccc; 
    box-shadow: 0 1px 1px #ccc;         
}

.bordered tr:hover {
    background: #fbf8e9;
    -o-transition: all 0.1s ease-in-out;
    -webkit-transition: all 0.1s ease-in-out;
    -moz-transition: all 0.1s ease-in-out;
    -ms-transition: all 0.1s ease-in-out;
    transition: all 0.1s ease-in-out;     
}    
    
.bordered td, .bordered th {
    border-left: 1px solid #ccc;
    border-top: 1px solid #ccc;
    padding: 10px;
    text-align: left;    
}

.bordered th {
    background-color: #a7bc7a;
    background-image: -webkit-gradient(linear, left top, left bottom, from(#ebf3fc), to(#dce9f9));
    background-image: -webkit-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:    -moz-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:     -ms-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:      -o-linear-gradient(top, #ebf3fc, #dce9f9);
    background-image:         linear-gradient(top, #ebf3fc, #dce9f9);
    -webkit-box-shadow: 0 1px 0 rgba(255,255,255,.8) inset; 
    -moz-box-shadow:0 1px 0 rgba(255,255,255,.8) inset;  
    box-shadow: 0 1px 0 rgba(255,255,255,.8) inset;        
    border-top: none;
    text-shadow: 0 1px 0 rgba(255,255,255,.5); 
}

.bordered td:first-child, .bordered th:first-child {
    border-left: none;
}

.bordered th:first-child {
    -moz-border-radius: 6px 0 0 0;
    -webkit-border-radius: 6px 0 0 0;
    border-radius: 6px 0 0 0;
}

.bordered th:last-child {
    -moz-border-radius: 0 6px 0 0;
    -webkit-border-radius: 0 6px 0 0;
    border-radius: 0 6px 0 0;
}

.bordered th:only-child{
    -moz-border-radius: 6px 6px 0 0;
    -webkit-border-radius: 6px 6px 0 0;
    border-radius: 6px 6px 0 0;
}

.bordered tr:last-child td:first-child {
    -moz-border-radius: 0 0 0 6px;
    -webkit-border-radius: 0 0 0 6px;
    border-radius: 0 0 0 6px;
}

.bordered tr:last-child td:last-child {
    -moz-border-radius: 0 0 6px 0;
    -webkit-border-radius: 0 0 6px 0;
    border-radius: 0 0 6px 0;
}

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
								
							</div>
							<div id="top-slot" class="span-19">
								<div class="row"  id="back">
									<div class="twelve columns">
										<?php
											if(isset($_GET['ViewStu']) && $_GET['ViewStu'] == "View")
											{
												require('AccountManagement/ViewStudent.php');
											}
											else if(isset($_GET['Viewpending']) && $_GET['Viewpending'] == "pending")
											{
												require('AccountManagement/StudPending.php');
											}
											else if(isset($_GET['Report']) && $_GET['Report'] == "Repo")
											{
												require('ReportManagement/ReportAccount.php');
											}
											?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> <!-- bd-slot -->	
			</div>
		</section>
	</section>
<?php 

require('AccountManagement/FacultyForm.php');
require('AccountManagement/StudentForm.php');
?>

<!-- pagination 
<script src="Javascript/jquery-2.0.3.js"></script>-->
<script src="Javascript/jquery-simple-pagination-plugin.js"></script>
<script>
(function($){

$('#first-container').simplePagination();

$('#second-container').simplePagination({
	items_per_page: 10,
	number_of_visible_page_numbers: 10
});

$('#third-container').simplePagination({
	items_per_page: 10
});

$('#fourth-container').simplePagination({
	first_content: '&lt;&lt;',
	previous_content: '<',
	next_content: '>',
	last_content: '>>'
});

$('#fifth-container').simplePagination({
	use_page_count: true
});

$('#sixth-container').simplePagination({
	items_per_page: 11,
	items_per_page_content: {
		'Six': 6,
		'Eleven': 11,
		'Seventeen': 17,
		'Thirty-three': 33,
		'Sixty-seven': 67
	}
});

})(jQuery);
</script>
<script>
	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
	ga('create', 'UA-48624238-1', 'ddenhartog.github.io');
	ga('send', 'pageview');
</script>


</body>
</html>