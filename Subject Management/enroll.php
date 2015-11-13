<?php


  $result = mysql_query("SELECT inst.*,sub.*,fr_subject.* FROM fr_ins_subject as sub,fr_staff as inst,fr_subject WHERE inst.uid = sub.uid AND fr_subject.SubCode = sub.Subject AND NOT EXISTS(SELECT * FROM  fr_stud_subject WHERE fr_stud_subject.subID = sub.ID AND fr_stud_subject.studID = '".$_SESSION['uid']."')") or die("Error:". mysql_error());             

?>

<div class="container"> 
  <form  name="frmUser" method="post" action="">
    <div  class="form_2">
      <div id="second-container" class="pagination">
          <div class="my-navigation">
            <div> <input class="buttom" type="button" name="enroll" id="btnSubmit"  value="ENROLL" onClick="setEnrollSub();" > </div>
             <div style="float:right"> Search: <input id="form-control" type="text" style="width:300px;" /></div>
          </div>
          <table class="bordered sortable search-table table table-striped" >
            <thead>
              <tr> 
                <th></th>
                <th >Instructor</th>      
                <th >Subject Code</th>
                <th >Description</th>
              </tr>
            </thead>
          <?php
            if(mysql_num_rows($result) > 0)
            {
               while($row = mysql_fetch_array($result))
               {
          ?>
              <tr>
                <td><input type="checkbox" name="subject[]" value="<?php echo $row['ID']; ?>" required></td>
                <td><?php echo $row['FirstN']." ".$row['LastN']; ?></td>       
                <td><?php echo $row['Subject']; ?></td>
                <td><?php echo $row['Description']; ?></td>

              </tr> 
            </form>        
          <?php
              }
            } 
          ?>
          </table>
         <div class="my-navigation">
            <div>
              Go to page <select class="simple-pagination-select-specific-page"></select>.
            </div>
          <div>
              Display <select class="simple-pagination-items-per-page"></select> items/page.
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


