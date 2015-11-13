<script type='text/javascript' src='Javascript/scripts/gen_validatorv31.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_ajax.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_moveable_popup.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_form_submitter.js'></script>
<div id='fg_formStudSub'>
    <div id="fg_StudSub_header">
        <div id="fg_StudSub_Title">Add subject</div>
        <div id="fg_StudSub_Close"><a href="javascript:fg_hideform('fg_formStudSub','fg_backgroundStudSub');">Close(X)</a></div>
    </div>

    <div id="fg_form_InnerStudSub">
   <form id='Folder' action='' method='post' accept-charset='UTF-8'>
  
     <div class="form">  
        <p class="contact"><label for="inst">Select Instructor :</label>
        <select class="select-style" id="inst" name="inst" onchange='this.form.submit()' required>
            <option value="">SELECT</option>
        <?php 
            $result = mysql_query("SELECT * FROM fr_user,fr_staff WHERE fr_user.UserID = fr_staff.uid AND fr_user.UserLvl BETWEEN  3 AND  4");
            if(mysql_num_rows($result))
            {
                while ($row = mysql_fetch_array($result)) {
            ?>
                 <option value="<?php echo $row['UserID']; ?>"><?php echo $row['FirstN']." ".$row['LastN']; ?></option>
            <?php
                }
            }
        ?>
         
        </select> <font style="color:red"> * </font>  <span style="color:red" class="" id="errmsg"></span>  </p> 
  
     <p class="contact"><label for="subject">&nbsp</label>
  </div>
 <form id='Folder' action='FileManagement/process_subject.php' method='post' accept-charset='UTF-8'>
    <div class="form">  
        
        <p class="contact"><label for="subject">Select Subject : </label> 
        <select class="select-style" id="subject" name="subject" required>
            <option value="">SELECT</option>
        <?php 
            $result = mysql_query("SELECT * FROM fr_ins_subject");
            if(mysql_num_rows($result))
            {
                while ($row = mysql_fetch_array($result)) {
            ?>
                 <option value="<?php echo $row['ID']; ?>"><?php echo $row['Subject']; ?></option>
            <?php
                }
            }
        ?>
         
        </select> <font style="color:red"> * </font>  <span style="color:red" class="" id="errmsg"></span>  </p> 
    
         <p class="contact"><label for="subject">&nbsp</label> 
    </div>
  

    <div class='container'>
        <input type='submit' name='Submit' value='Submit' />
        <a href="javascript:fg_hideform('fg_formStudSub','fg_backgroundStudSub');"> <input type='button' name='Submit' value='Close' /> </a>
    </div>
      <div class='container'>
       
        </div>
    </form>
    </div>
</div>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("Folder");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Please provide folder name");

    document.forms['Folder'].refresh_container=function()
    {
        var formpopup = document.getElementById('fg_formStudSub');
        var innerdiv = document.getElementById('fg_form_InnerStudSub');
        var b = innerdiv.offsetHeight+30+30;

        formpopup.style.height = b+"px";
    }

    document.forms['Folder'].form_val_onsubmit = document.forms['Folder'].onsubmit;


    document.forms['Folder'].onsubmit=function()
    {
        if(!this.form_val_onsubmit())
        {
            this.refresh_container();
            return false;
        }

        return true;
    }
    function fg_submit_form()
    {
        //alert('submiting form');
        var containerobj = document.getElementById('fg_form_InnerStudSub');
        var sourceobj = document.getElementById('fg_submit_success_message');
        var error_div = document.getElementById('fg_server_errors');
        var formobj = document.forms['Folder']

        var submitter = new FG_FormSubmitter("popup-contactform.php",containerobj,sourceobj,error_div,formobj);
        var frm = document.forms['Folder'];

        submitter.submit_form(frm);
    }

// ]]>
</script>

<div id='fg_backgroundStudSub'></div>

<div id='fg_submit_success_message'>
 

        <a href="javascript:fg_hideform('fg_formStudSub','fg_backgroundStudSub');">Close this window</a>
</div>
