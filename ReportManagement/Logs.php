<?php
$result = mysql_query("SELECT UserID FROM fr_user WHERE UserName ='".$_SESSION['user']."'");

	$row = mysql_fetch_array($result);
if($_SESSION['login'] == "ADMIN" || $_SESSION['login'] == "DEAN")
{
	$result = mysql_query("SELECT * FROM fr_rep");
}
else if($_SESSION['login'] == "Instructor")
{
	$result = mysql_query("SELECT * FROM fr_rep WHERE uid = '".$row['UserID']."' || UserLvl = '1'");
}
else if($_SESSION['login'] == "Student")
{
	$result = mysql_query("SELECT * FROM fr_rep WHERE uid = '".$row['UserID']."'");
}
			$ctr = 0;									
																								
		if(mysql_num_rows($result)> 0)
		{
	?>
		<div id="second-container" class="pagination">
				<div class="my-navigation">
					<div style="float:right"> Search: <input id="form-control" type="text" style="width:300px;" /></div>
				</div>
		<table class="bordered sortable search-table table table-striped" >
			<thead>

			<tr> 
				<th>#</th>        
				<th>Description</th>
				<th>Date Modified</th>
			</tr>
			</thead>
	<?php
			while($row = mysql_fetch_array($result))
			{
				$ctr++;
	?>
			<tr>
		
				<td><?php echo $ctr; ?></td>        
				<td><?php echo $row['Description']; ?></td>
				<td><?php echo $row['DateMod']; ?></td>
			</tr>        
			
		
	<?php
			}
		echo '</table>
				<div class="my-navigation">
					<!--<div>
						Go to page <select class="simple-pagination-select-specific-page"></select>.
					</div>-->
					<div>
					    Display <select class="simple-pagination-items-per-page"></select> items per page.
					</div>
					<div class="simple-pagination-page-x-of-x page"></div>
					<div class="simple-pagination-showing-x-of-x page"></div>
					<div style="float:right">	
						<div class="simple-pagination-first page"></div>
						<div class="simple-pagination-previous page"></div>
						<div class="simple-pagination-page-numbers"></div>
						<div class="simple-pagination-next page"></div>
						<div class="simple-pagination-last page"></div>			
					</div>
				</div>
			</div>';	
			
		}	