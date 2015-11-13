<?php

if(isset($_POST['submit']))
{
    $day = array();

    $result = mysql_query("SELECT * FROM fr_path WHERE pathID = 1");
    $row = mysql_fetch_array($result);
    $row['pathName'];

    $result1 = mysql_query("SELECT fr_user.*,position.*,fr_staff.* FROM fr_staff,fr_user,position WHERE fr_staff.uid = fr_user.UserID AND  position.UserLvl = fr_user.UserLvl AND fr_user.UserID = '".$_SESSION['inst']."'");
    $row1 = mysql_fetch_array($result1);
    $row1['Position'];

    

  $ItemCnt = count($_POST['Subject']);
  for($i=0; $i < $ItemCnt; $i++) 
  {
    $path = $row['pathName']."/".$row1['Position']."/".$row1['LastN'].", ".$row1['FirstN'];
    if(isset($_POST['Monday'][$i+1]))
    {
      if(isset($day[$i]))
      {
        $day[$i] .= $_POST['Monday'][$i+1];
      }
      else
      {
        $day[$i] = $_POST['Monday'][$i+1];
      }
      
    }
    if(isset($_POST['Teusday'][$i+1]))
    {
       if(isset($day[$i]))
      {
        $day[$i] .= $_POST['Teusday'][$i+1];
      }
      else
      {
        $day[$i] = $_POST['Teusday'][$i+1];
      }
    }
    if(isset($_POST['Wednesday'][$i+1]))
    {      
       if(isset($day[$i]))
      {
        $day[$i] .= $_POST['Wednesday'][$i+1];
      }
      else
      {
        $day[$i] = $_POST['Wednesday'][$i+1];
      }
    }
    if(isset($_POST['Thursday'][$i+1]))
    {
       if(isset($day[$i]))
      {
        $day[$i] .= $_POST['Thursday'][$i+1];
      }
      else
      {
        $day[$i] = $_POST['Thursday'][$i+1];
      }
    }
    if(isset($_POST['Friday'][$i+1]))
    {
       if(isset($day[$i]))
      {
        $day[$i] .= $_POST['Friday'][$i+1];
      }
      else
      {
        $day[$i] = $_POST['Friday'][$i+1];
      }
    }

    /*$Subject = $path."/".$_POST['Course'][$i+1];
    if(!is_dir($Subject))
    {
      mysql_query("INSERT INTO  fr_course_path(Folder_name,path,uid) VALUES('".$_POST['Course'][$i+1]."','".$Subject."','".$_SESSION['uid']."')");
      mkdir ($Subject, 0700);
    }*/

    $path .= "/".$_POST['Subject'][$i+1];

    $time = $_POST['timeFrom'][$i+1]."-".$_POST['timeTo'][$i+1];  
  

    mysql_query("INSERT INTO fr_ins_subject(uid,Subject,Description,SubPath,Date,Time,Units,Folder_Owner) VALUES('".$_SESSION['inst']."','".$_POST['Subject'][$i+1]."','".$_POST['desc'][$i+1]."','".$path."','".$day[$i]."','".$time."','".$_POST['Units'][$i+1]."','".$_SESSION['uid']."')");
    mkdir ($path, 0700);

  }

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
                      '<p class="contact"><label for="Units">Units</label></p>' +
                      '<input id="units" class="Units" name="Units['+rowNum+']" placeholder="Units" required="" type="text">' +
                    '</td>'+
                  '</tr>'+
                  '<tr>'+
                    '<td>'+
                      '<p class="contact"><label>DAYS</label></p>'+
                      '<input id="Monday" name="Monday['+rowNum+']" value="M" tabindex="2" type="checkbox">' +
                      '<label for="Monday">Monday |</label>' +
                      '<input id="Teusday" name="Teusday['+rowNum+']" value="T"  tabindex="2" type="checkbox">'+
                      '<label for="Teusday"> Teusday |</label>' +
                      '<input id="Wednesday" name="Wednesday['+rowNum+']" value="W"  tabindex="2" type="checkbox">' +
                      '<label for="Wednesday"> Wednesday </label>'+
                      '<p class="contact"></p>' +
                      '<input id="Thursday" name="Thursday['+rowNum+']" value="TH"  tabindex="2" type="checkbox">' +
                      '<label for="Thursday"> Thursday |</label>'+
                      '<input id="Friday" name="Friday['+rowNum+']" value="F"  tabindex="2" type="checkbox">' +
                      '<label for="Friday"> Friday</label>'+
                    '</td>'+
                    '<td>'+
                        '<p class="contact"><label>TIME</label></p>' +
                        '<p class="contact"><label style="padding-right:90px">From:</label><label>To:</label></p>' +
                        '<input id="time" name="timeFrom['+rowNum+']" required="" tabindex="1" type="time">' +
                        '&nbsp <input id="tomf" name="timeTo['+rowNum+']" required="" tabindex="1" type="time">' +
                    '</td>'+
                  '</tr>'  +
                  '<tr>'+
                    '<td></td><td></td>'+
                    '<td>'+
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

