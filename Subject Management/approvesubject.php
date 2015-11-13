<?php
 
    $result = mysql_query("SELECT stud.*,sub.*,studsub.*,fr_subject.* FROM fr_ins_subject as sub,fr_stud as stud,fr_stud_subject as studsub , fr_subject WHERE fr_subject.SubCode = sub.Subject AND studsub.subID = sub.ID AND studsub.studID = stud.uid AND sub.uid = '".$_SESSION['uid']."' AND studsub.status='DISAPPROVED'");
                   
?>


  <form  name="frmUser" method="post" action=""> 
  <div class="container">   
    <div  class="form_2"> 
      <div id="second-container" class="pagination">
      <?php
          if(mysql_num_rows($result)> 0)
          {
      ?>
        <div class="my-navigation">
          <div> <input class="buttom" type="button" name="enroll" id="btnSubmit"  value="APPROVE" onClick="setApproveSubject();" > </div>
          <div> <input class="buttom" type="button" name="enroll" id="btnSubmit"  value="DISAPPROVE" onClick="setDisapproveSubject();" > </div>  
        </div>
        <table class="bordered sortable search-table table table-striped">
          <thead>
            <tr> 
              <th></th>
              <th >Subject Code</th>
              <th >ID Number</th>
              <th >Student</th>      
              <th >Description</th>
            </tr>
          </thead>
        <?php
            while($row = mysql_fetch_array($result))
            {
        ?>
            <tr>
              <td><input type="checkbox" name="subject[]" value="<?php echo $row['sID']?> ?>"></td>
              <td><?php echo $row['Subject']; ?></td>
              <td><?php echo $row['ControlNo']?></td>  
              <td><?php echo $row['FName']." ".$row['LName']; ?></td>       
              <td><?php echo $row['Description']; ?></td>
            </tr>  
        <?php
            }
            echo "</table>";
         }
         else
         {
            echo display_error_message('This Subject is empty');
         }
        ?>
      </div> 
    </div>      
  </div>
 </form> 

