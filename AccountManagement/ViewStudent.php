
<div class="container">   
    <div  class="form_2">
		<div id="second-container" class="pagination">
		<form  name="frmUser" method="post" action="">
			<div class="my-navigation">
				<div> 
					<a href='javascript:fg_popup_form("fg_formStudent","fg_form_InnerStudent","fg_backgroundStudent");'>
						<input class="buttom" type="button" name="delete" id="btnSubmit"  value="Add"  >
					</a> 
				 	<input class="buttom" type="button" name="update" id="btnSubmit"  value="Edit" onClick="setUpdateStud();"  > 
				 
				 	<a href='javascript:fg_popup_form("fg_formContainer","fg_form_InnerContainer","fg_backgroundpopup");'>
						<input class="buttom" type="button" name="CSV" id="btnSubmit"  value="UPLOAD CSV FILE"  >
					</a> 
				 </div>
		
				<div style="float:right"> Search: <input id="form-control" type="text" style="width:300px;" /></div>

			</div>
					<table class="bordered sortable search-table table table-striped" >
							<thead>

							<tr>
								<th class="group-false"><input type="checkbox" id="SelectAll"/></th>       
								<th class="group-false">Name</th>
								<th>Username</th>
								<th>Course/Year</th>
								<th>Last Login</th>
								<th>Last Log-Out</th>
								<th>Status</th>
							</tr>
							</thead>
				<?php
					$result = mysql_query("SELECT fr_user.*,fr_stud.* FROM fr_user,fr_stud WHERE fr_user.UserLvl = 1  AND fr_user.UserID = fr_stud.uid") or die ("Student :". mysql_error());
					
					if(mysql_num_rows($result)> 0)
					{
						while($row = mysql_fetch_array($result))
						{
				?>
						<tr>
							<td><input class="check" type="checkbox" name="users[]" value="<?php echo $row['UserName']; ?>"></td>      
							<td><?php echo $row['FName'].' &nbsp'.$row['LName'] ; ?></td>
							<td><?php echo $row['UserName']; ?></td>
							<td><?php echo $row['Course'].' - '.$row['Year']; ?></td>
							<td><?php echo $row['last_login_date']; ?></td>
							<td><?php echo $row['last_logout_date']; ?></td>
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