<?php

  if($_SESSION['UserLvl'] == 1)
  {
    $result = mysql_query("SELECT stud.*,sub.*,studsub.*,fr_subject.* FROM fr_ins_subject as sub,fr_stud as stud,fr_stud_subject as studsub , fr_subject WHERE fr_subject.SubCode = sub.Subject AND  studsub.subID = sub.ID AND studsub.studID = stud.uid AND studsub.studID = '".$_SESSION['uid']."'") or die(mysql_error());
  }
  else
  {
    $result = mysql_query("SELECT stud.*,sub.*,studsub.*,fr_subject.* FROM fr_ins_subject as sub,fr_stud as stud,fr_stud_subject as studsub , fr_subject WHERE fr_subject.SubCode = sub.Subject AND studsub.subID = sub.ID AND studsub.studID = stud.uid AND sub.uid = '".$_SESSION['uid']."'")or die(mysql_error()); 
  }
                   
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="UTF-8">


</head>
  <div class="container">   
      <div  class="form_2"> 
        <div id="second-container" class="pagination">
        <div class="my-navigation">
            <div style="float:right"> Search: <input id="form-control" type="text" style="width:300px;" /></div>
          </div>
        <table class="bordered sortable search-table table table-striped">
          <thead>
            <tr> 
              <th class="group-word">Subject Code</th>
              <th class="group-false">ID Number</th>
              <th class="group-false">Student</th>      
              <th class="group-false">Description</th>
            </tr>
          </thead>
        <?php
          if(mysql_num_rows($result)> 0)
          {
            while($row = mysql_fetch_array($result))
            {
        ?>
            <tr>
              <td><?php echo $row['Subject']; ?></td>
              <td><?php echo $row['ControlNo']?></td>  
              <td><?php echo $row['FName']." ".$row['LName']; ?></td>       
              <td><?php echo $row['Description']; ?></td>
            </tr>        
        <?php
            }
         } 
        ?>
        </table>
      </div> 
    </div>     
  </div>
</html>

