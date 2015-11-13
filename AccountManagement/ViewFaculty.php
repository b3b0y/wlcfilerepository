<div class="container">
	<div  class="form_2">
	<form  name="frmUser" method="post" action="">
		<div id="second-container" class="pagination">
			<div class="my-navigation">	
				<?php
					if($_SESSION['login'] == "ADMIN")
					{
				?>
					<div> 
						<a href='javascript:fg_popup_form("fg_formFaculty","fg_form_InnerFaculty","fg_backgroundFaculty");'>
							<input class="buttom" type="button" name="delete" id="btnSubmit"  value="Add"  >
						</a> 
					<input class="buttom" type="button" name="update" id="btnSubmit"  value="Edit" onClick="setUpdateStaff();"  > </div>
					<div style="float:right"> Search: <input id="form-control" type="text" style="width:300px;" /></div>
				<?php
					}
				?>
					<!-- <div style="float:right"> Search: <input id="form-control" type="text" style="width:300px;" /></div> -->
			</div>
			<table class="bordered sortable search-table table table-striped" >
				<thead>
					<tr>
						<th><input type="checkbox" id="SelectAll"/></th>       
						<th>Name</th>
						<th>Username</th>
					
						<th>Last Login</th>
						<th>Last Log-Out</th>
						<th>User Level</th>
						<th>Status</th>
					</tr>
				</thead>
	<?php
		if($_SESSION['Ulvl'] == "5")
		{

			$result = mysql_query("SELECT fr_user.*,position.*,fr_staff.* FROM fr_user,position,fr_staff WHERE fr_user.UserLvl > 1 AND fr_user.UserLvl = position.UserLvl AND fr_user.UserID = fr_staff.uid ") or die ("Admin :". mysql_error());
		}
		else if($_SESSION['Ulvl'] == "4")
		{
			$result = mysql_query("SELECT fr_user.*,position.*,fr_staff.* FROM fr_user,position,fr_staff WHERE fr_user.UserLvl < 4 AND fr_user.UserLvl = position.UserLvl AND fr_user.UserID = fr_staff.uid ") or die ("DEAN :". mysql_error());

		}
		else if($_SESSION['Ulvl'] == "3")
		{
			$result = mysql_query("SELECT fr_user.*,position.*,fr_staff.* FROM fr_user,position,fr_staff WHERE fr_user.UserLvl < 3 AND fr_user.UserLvl = position.UserLvl AND fr_user.UserID = fr_staff.uid ") or die ("Instructor :". mysql_error());
		}

		
		if(mysql_num_rows($result)> 0)
		{
			while($row = mysql_fetch_array($result))
			{
	?>
			<tr>
				<td><input class="check" type="checkbox" name="users[]" value="<?php echo $row['UserName']; ?>"></td>      
				<td><?php echo $row['FirstN'].' &nbsp'.$row['LastN'] ; ?></td>
				<td><?php echo $row['UserName']; ?></td>
			
				<td><?php echo $row['last_login_date']; ?></td>
				<td><?php echo $row['last_logout_date']; ?></td>
				<td><?php echo $row['Position']; ?></td>
				<td><?php echo $row['UserStat']; ?></td>
			</tr>        
		</form>
	<?php
			}
	?>
		
	<?php	
		}	
		else
		{

			echo "<tr > <td colspan='9'> File Records  Empty! </td></tr>";
		}
	?>
		</table>
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
	</div>	
	</div>	
</div>