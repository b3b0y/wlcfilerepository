<ul>
	<li>
		<a><span>Report Management</span></a>
		<ul>
			<li> <a  href='Admin.php?Report=Logs'><span>LOGS</span></a> </li>
		</ul>
	</li>
	<?php 
	if($_SESSION['UserLvl'] >= 4)
	{
	?>
		<li><a href='#'><span>Account Management</span></a>
			<ul>
				<li> <a href='Admin.php?ViewSta=View'><span>FACULTY</span></a> </li>
			    <li> <a href='Admin.php?ViewStu=View'><span>STUDENT</span></a> </li>
			</ul>
		</li>

		<li><a href='#'><span>System Setting</span></a></li>
	<?php
	}
	?>
	<li class='last'><a href='#'><span>Subject Management</span></a>
		<ul>
			<li>
		    	<a href='Admin.php?Mysub=Mysub'><span>MY SUBJECT</span></a>  
		   	</li>
		<?php 
			if($_SESSION['UserLvl'] >= 4)
			{
		?>
			<li>
		    	<a href='Admin.php?Sem=Semester'><span>SEMESTER</span></a>
		    </li>
			<li>
		    	<a href='Admin.php?ViewSubj=Subject'><span>SUBJECT</span></a>
		    </li>
		    <li>
		    	<a ><span>FACULTY SUBJECT</span></a>
		   		<ul>
				    <li>
				    	<a href='Admin.php?LOADING=LOADING'><span>ADD SUBJECT</span></a>
				    </li>
				     <li>
				    	<a href='Admin.php?viewall=Subject'><span>VIEW SUBJECT</span></a>
				    </li>
				</ul>
		   </li>
		<?php 
			}
		?>
		    <li>
		    	<a href='Admin.php?studsub=Subject'><span>STUDENT SUBJECT</span></a>
		    	<ul>
				    <li>
				    	<a href='Admin.php?approval=Subject'><span>SUBJECT APPROVAL</span></a>
				    </li>
				</ul>
		   </li>
		</ul>
	</li>
</ul>