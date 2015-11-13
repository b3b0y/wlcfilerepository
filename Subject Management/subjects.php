<?php

  if(isset($_POST['Submit']))
  {
      mysql_query("INSERT INTO  fr_subject(SubCode,Description,SemID) VALUES('".$_POST['Subject']."','".$_POST['desc']."','".$_POST['SemID']."')") or die("Error:". mysql_error());
      
      echo '<script> window.location.href="Admin.php?ViewSubj=Subject"; </script>';
  }

  $result = mysql_query("SELECT sub.*,sem.* FROM fr_subject as sub , fr_semester as sem WHERE sub.SemID = sem.SemID")               
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
          <a href='javascript:fg_popup_form("fg_formSubject","fg_form_InnerContainer","fg_backgroundpopup");'>
            <input class="buttom" type="button" name="CSV" id="btnSubmit"  value="ADD"  >
          </a> 
          <input class="buttom" type="button" name="enroll" id="btnSubmit"  value="EDIT" onClick="" > </div>
          <div style="float:right"> Search: <input id="form-control" type="text" style="width:300px;" /></div>
        </div>
        <table class="bordered sortable search-table table table-striped" >
          <thead>
            <tr>    
              <th class="group-word">Subject Code</th>
              <th class="group-false">Description</th>
              <th class="group-false">Semester / S.Y.</th>
              <th class="group-false">Status</th>

            </tr>
          </thead>
        <?php
          if(mysql_num_rows($result)> 0)
          {
            while($row = mysql_fetch_array($result))
            {
      
        ?>
            <tr>
        
              <td><?php echo $row['SubCode']; ?></td>
              <td><?php echo $row['Description']; ?></td>
               <td><?php echo $row['Semester']." - ".$row['SY']; ?></td>
              <td><?php echo $row['status']; ?></td>

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

