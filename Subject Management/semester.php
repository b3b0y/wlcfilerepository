<?php

  if(isset($_POST['Submit']))
  {

      //mysql_query("INSERT INTO  fr_semester(Semester,SY,Start_date) VALUES('".$_POST['sem']."','".$_POST['sy']."','".$_POST['date']."')") or die("Error:". mysql_error());
      mysql_query("INSERT INTO  fr_semester(Semester,SY) VALUES('".$_POST['sem']."','".$_POST['sy']."')") or die("Error:". mysql_error());
      
     echo '<script> window.location.href="Admin.php?Sem=Semester"; </script>';
  }

  $result = mysql_query("SELECT * FROM fr_semester")               
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
          <div> 
          <a href='javascript:fg_popup_form("fg_formSem","fg_form_InnerContainer","fg_backgroundpopup");'>
            <input class="buttom" type="button" name="CSV" id="btnSubmit"  value="ADD SEMESTER"  >
          </a> 
          <input class="buttom" type="button" name="enroll" id="btnSubmit"  value="EDIT" onClick="" > </div>
          <div style="float:right"> Search: <input id="form-control" type="text" style="width:300px;" /></div>
        </div>
        <table class="bordered sortable search-table table table-striped" >
          <thead>
            <tr>    
              <th class="group-word">Semester</th>
              <th class="group-false">School Year</th>
              <th class="group-false">Date</th>

            </tr>
          </thead>
        <?php
          if(mysql_num_rows($result)> 0)
          {
            while($row = mysql_fetch_array($result))
            {
      
        ?>
            <tr>
        
              <td><?php echo $row['Semester']; ?></td>
              <td><?php echo $row['SY']; ?></td>
              <td><?php echo $row['Start_date']." - ".$row['End_date']; ?></td>

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

