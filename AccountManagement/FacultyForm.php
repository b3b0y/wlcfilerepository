

<script type='text/javascript' src='Javascript/scripts/gen_validatorv31.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_ajax.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_moveable_popup.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_form_submitter.js'></script>

<div id='fg_formFaculty'>
    <div id="fg_Faculty_header">
        <div id="fg_Faculty_Title">Faculty</div>
        <div id="fg_Faculty_Close"><a href="javascript:fg_hideform('fg_formFaculty','fg_backgroundFaculty');"><img src="Images/close.png" width="20px"></a></div> 
    </div>

    <div id="fg_form_InnerFaculty">
        <div  class="form" > 
            <form name="contactform" id="contactform" method="post" action="AccountManagement/chckAcct.php"> 
                <p class="contact">Legend:<font style="color:red;" size="5px">  * </font> - Required field </p>
                
                <p class="contact" style="border: 1px solid gray;Width:400px;"></p> 

                <p class="contact"><label for="Ulevel">User Level  <font style="color:red;"> *</font></label></p>
                <select class="select-style" name="Ulevel" id="Ulevel" required>
                    <option Selected value="">PLEASE SELECT
                    <?php
                    if($_SESSION['Ulvl'] == 5)
                    {
                        echo "<option value='4'>Dean";
                    }
                    ?>
                    <option value="3">Instructor
                </select>
                <!--<div id="All"> -->
                <div>  
                    <p class="contact" style="border: 1px solid gray;Width:400px;"></p>     
                    
                    <p class="contact"><label for="Fname">First Name<font style="color:red"> *</font></label> <span style="color:red" class="" id="errmsgF"></p> 
                    <input id="Fname" name="Fname" placeholder="First Name" tabindex="1" type="text" required=""  value="<?php if(isset($_SESSION['fname'])) {echo$_SESSION['fname']; } ?>"> 
                     <p class="contact"><label for="Mname">Middle Name</label> <span style="color:red" class="" id="errmsgM"></p> 
                    <input id="Mname" name="Mname" placeholder="Middle Name"  tabindex="2" type="text"  value="<?php if(isset($_SESSION['mname'])) {echo $_SESSION['mname']; } ?>"> 
                     <p class="contact"><label for="Lname">Last Name<font style="color:red"> *</font></label> <span style="color:red" class="" id="errmsgL"></p> 
                    <input id="Lname" name="Lname" placeholder="Last Name" tabindex="3" type="text" required="" value="<?php if(isset($_SESSION['lname'])) {echo $_SESSION['lname']; } ?>"> 
                     
                     <p class="contact"><label for="username">Username <font style="color:red"> *</font></label></p> 
                    <input id="username" name="uname" placeholder="Username" required="" tabindex="4" type="text" value=""> 
                    <div class="username_avail_result" id="username_avail_result"></div>

                    <p class="contact"><label for="password">Password <font style="color:red"> *</font></label></p> 
                    <input id="password" type="password" id="password" name="pass" placeholder="Password" tabindex="5" required="" > 
                    <div class="password_strength" id="password_strength"></div>

                    <p class="contact"><label for="repassword">Confirm your password <font style="color:red"> *</font></label></p> 
                    <input id="repassword" type="password" id="repassword" name="repass" placeholder="Confirm Password" tabindex="6" required=""> 
                    <div class="repassword_strength" id="repassword_strength"></div>
                    
                    <p class="contact" style="border: 1px solid gray;Width:400px;"></p> 
                    <center>
                        <input class="buttom" name="submit" id="submit" tabindex="7" value="SUBMIT" type="submit"> 
                        <a href="javascript:fg_hideform('fg_formFaculty','fg_backgroundFaculty');"> <input type='button' name='Submit' value='Close' class="buttom" /> </a>
                    </center>
                </div>
            </form>
        </div> 

    
    </div>
</div>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->
<!--
<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("contactform");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Please provide folder name");

    document.forms['contactform'].refresh_container=function()
    {
        var formpopup = document.getElementById('fg_formFaculty');
        var innerdiv = document.getElementById('fg_form_InnerFaculty');
        var b = innerdiv.offsetHeight+30+30;

        formpopup.style.height = b+"px";
    }

    document.forms['contactform'].form_val_onsubmit = document.forms['contactform'].onsubmit;


    document.forms['contactform'].onsubmit=function()
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
        var containerobj = document.getElementById('fg_form_InnerFaculty');
        var sourceobj = document.getElementById('fg_submit_success_message');
        var error_div = document.getElementById('fg_server_errors');
        var formobj = document.forms['contactform']

        var submitter = new FG_FormSubmitter("AccountManagement/chckAcct.php",containerobj,sourceobj,error_div,formobj);
        var frm = document.forms['contactform'];

        submitter.submit_form(frm);
    }

// ]]>
</script> -->

<div id='fg_backgroundFaculty'></div>

<div id='fg_submit_success_message'>
 

        <a href="javascript:fg_hideform('fg_formFaculty','fg_backgroundFaculty');">Close this window</a>
</div>
