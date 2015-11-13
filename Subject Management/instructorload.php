
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="UTF-8">
</head>
<div class="container">   
      <div  class="form_2">
        
        <?php

        ?>
        <form name="" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
          <p class="contact"><label for="phone">Search:</label>
          <select class="select-style" name="inst" onchange='this.form.submit()'>
            <option value="">SELECT INSTRUCTOR</option>
            <?php
              $result = mysql_query("SELECT fr_user.*,fr_staff.* FROM fr_staff, fr_user WHERE fr_staff.uid = fr_user.UserID AND fr_user.UserLvl BETWEEN 3 AND 4");
              if(mysql_num_rows($result))
              {
                while ($row = mysql_fetch_array($result)) 
                {
             ?>
                <option value="<?php echo $row['uid']; ?>"><?php echo $row['FirstN']." ".$row['midN']." ".$row['LastN']; ?></option>
             <?php
                }
              }
             ?>
          </select></p> 
        </form>
        <p class="contact">&nbsp</p>  
        <?php
          
          if(isset($_POST['inst']))
          {
            $_SESSION['inst'] = $_POST['inst'];
            $result = mysql_query("SELECT * FROM fr_staff WHERE uid = '".$_POST['inst']."'");
            if(mysql_num_rows($result))
            {
              $row = mysql_fetch_array($result);
        ?>
            <p class="contact"> <h1> Name: <?php echo $row['FirstN']." ".$row['midN']." ".$row['LastN']; ?> </h1></p> 
        <?php
            }
        ?>
       <div class="container"> 
            <form  name="frmUser" method="post" action="">
              <div  class="form_2">
                <div id="second-container" class="pagination">
                    <div class="my-navigation">
                      <div> <input class="buttom" type="button" name="enroll" id="btnSubmit"  value="ADD SUBJECT" onClick="setEnrollSubInst();" > </div>
                       <div style="float:right"> Search: <input id="form-control" type="text" style="width:300px;" /></div>
                    </div>
                    <table class="bordered sortable search-table table table-striped" >
                      <thead>
                        <tr> 
                          <th ></th>      
                          <th >Subject Code</th>
                          <th >Description</th>
                        </tr>
                      </thead>
                    <?php
                       $result = mysql_query("SELECT * FROM fr_subject WHERE NOT EXISTS (SELECT * FROM fr_ins_subject WHERE fr_subject.SubCode =  fr_ins_subject.Subject AND fr_ins_subject.uid = '".$_POST['inst']."') AND status ='NOT ASSIGNED'");

                      if(mysql_num_rows($result) > 0)
                      {
                         while($row = mysql_fetch_array($result))
                         {
                    ?>
                        <tr>
                          <td><input type="checkbox" name="subject[]" value="<?php echo $row['SubCode']; ?>" required></td>       
                          <td><?php echo $row['SubCode']; ?></td>
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
        <?php
          }
        ?>
      </div>      
    </div>
</html>

<!--
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta charset="UTF-8">
</head>
<div class="container">   
      <div  class="form_2">
        
        <?php

        ?>
        <form name="" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
          <p class="contact"><label for="phone">Search:</label>
          <select class="select-style" name="inst" onchange='this.form.submit()'>
            <option value="">SELECT INSTRUCTOR</option>
            <?php
              $result = mysql_query("SELECT fr_user.*,fr_staff.* FROM fr_staff, fr_user WHERE fr_staff.uid = fr_user.UserID AND fr_user.UserLvl BETWEEN 3 AND 4");
              if(mysql_num_rows($result))
              {
                while ($row = mysql_fetch_array($result)) 
                {
             ?>
                <option value="<?php echo $row['uid']; ?>"><?php echo $row['FirstN']." ".$row['midN']." ".$row['LastN']; ?></option>
             <?php
                }
              }
             ?>
          </select></p> 
        </form>
        <p class="contact">&nbsp</p>  
        <?php
          
          if(isset($_POST['inst']))
          {
            $_SESSION['inst'] = $_POST['inst'];
            $result = mysql_query("SELECT * FROM fr_staff WHERE uid = '".$_POST['inst']."'");
            if(mysql_num_rows($result))
            {
              $row = mysql_fetch_array($result);
        ?>
            <p class="contact">Name: <label for="phone"><?php echo $row['FirstN']." ".$row['midN']." ".$row['LastN']; ?></label></p> 
        <?php
            }
        ?>
        <p class="contact">&nbsp</p> 
        <input class="buttom" onclick="addRow();" type="button" value="ADD Subject Field" />
        <p class="contact" style="border: 1px solid gray;Width:930px;"></p>     

        <form name="form1" method="post" action="Admin.php?LOADING=LOADING">
          <div id="itemRows">

          </div>   
          <p class="contact"><label ></label></p>
          <center>
            <input class="buttom" name="submit" id="submit" tabindex="5" value="Add Load" type="submit">    
          </center>   
        </form> 
        <?php
          }
        ?>
      </div>      
    </div>
<script type="text/javascript">
  var rowNum = 0;
  function addRow() 
  {
    rowNum ++;
  
    var row = '<table id="rowNum'+rowNum+'">'+
                  '<tr>'+
                    '<td>'+
                      '<p class="contact"><label for="Subject">Subject Code</label></p>' +
                      '<input id="Subject" name="Subject['+rowNum+']" placeholder="Subject Code" required="" tabindex="1" type="text">' +
                    '</td>'+
                    '<td>'+
                      '<p class="contact"><label for="desc">Description</label></p>' +
                      '<input id="desc" class="desc" name="desc['+rowNum+']" placeholder="Description" required="" type="text">' +
                    '</td>'+
                    '<td>'+
                      '<p class="contact"><label for="desc">&nbsp</label></p>' +
                      '<input  class="buttom"  type="button" value="Remove" onclick="removeRow('+rowNum+');">' +
                    '</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td colspan="3"><p class="contact" style="border: 1px solid gray;Width:900px;"> </td><td></td>'+
                  '</tr>'+
              '</table> </p>';
    jQuery('#itemRows').append(row);
  }

  function removeRow(rnum) 
  {
    if(confirm("Are you sure want to Delete this field?")) 
    {
      jQuery('#rowNum'+rnum).remove();
    }
    

  }
  </script>
</html>
-->



