<?php

  $result = mysql_query("SELECT fr_ins_subject.*,fr_subject.* FROM fr_ins_subject,fr_subject WHERE fr_subject.SubCode = fr_ins_subject.Subject AND fr_ins_subject.uid = '".$_SESSION['uid']."'");
  $result1 = mysql_query("SELECT * FROM fr_staff WHERE uid = '".$_SESSION['uid']."'");
                        
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
        <?php
            if(mysql_num_rows($result1))
            {
              $row = mysql_fetch_array($result1);
        ?>
           <h1> Name: <?php echo $row['FirstN']." ".$row['midN']." ".$row['LastN']; ?></h1>
           <div style="float:right"> Search: <input id="form-control" type="text" style="width:300px;" /></div> 
        <?php
            }
        ?>
        </div>
        <table class="bordered sortable search-table table table-striped" >
          <thead>
            <tr>    
              <th class="group-word">Subject Code</th>
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

