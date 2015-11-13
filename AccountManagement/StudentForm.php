

<script type='text/javascript' src='Javascript/scripts/gen_validatorv31.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_ajax.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_moveable_popup.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_form_submitter.js'></script>

<div id='fg_formStudent'>
    <div id="fg_Student_header">
        <div id="fg_Student_Title">Student</div>
        <div id="fg_Student_Close"><a href="javascript:fg_hideform('fg_formStudent','fg_backgroundStudent');"><img src="Images/close.png" width="20px"></a></div> 
    </div>

    <div id="fg_form_InnerStudent">
        <div  class="form" >
        <?php
            $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $cpass = array(); //remember to declare $pass as an array
        $cuname = array();
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache]
        
        
        for($c = 0; $c < 1; $c++)
        {
            //password
            for ($i = 0; $i < 8; $i++) {
                $n = rand(0, $alphaLength);
                
                $cpass[$i] = $alphabet[$n];
            }   
            
            $pass[] = implode($cpass);
        }
        for($a = 0; $a < count($pass); $a++)
        {
            $pass = $pass[$a]; //turn the array into a string
            
        }

        ?>
        <script>
            /*var chars = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
            var string_length = 8;
            var randomstring = '';
            var charCount = 0;
            var numCount = 0;
            for (var i=0; i<string_length; i++) 
            {
                // If random bit is 0, there are less than 3 digits already saved, and there are not already 5 characters saved, generate a numeric value. 
                if((Math.floor(Math.random() * 2) == 0) && numCount < 3 || charCount >= 5) 
                {
                    var rnum = Math.floor(Math.random() * 10);
                    randomstring += rnum;
                    numCount += 1;
                } 
                else 
                {
                    // If any of the above criteria fail, go ahead and generate an alpha character from the chars string
                    var rnum = Math.floor(Math.random() * chars.length);
                    randomstring += chars.substring(rnum,rnum+1);
                    charCount += 1;
                }
            }*/
        </script>
                <p class="contact">Legend:<font style="color:red;" size="5px">  * </font> - Required field </p>

                <h1>Add Student Account</h1>
                <p class="contact" style="border: 1px solid gray;Width:400px;"></p> 
                <br>
                
                <!--<input class="buttom" name="gen" id="submit" tabindex="2" value="ADD FORM" type="button" onclick="addRow(this.form);">-->
          
        <form id="Studentform" name="Studentform" method="post" action="AccountManagement/chckAcct.php?Student=Student">

            <p class="contact"><label for="ControlNo">Enter Control Number <font style="color:red"> * </font> </label> <span style="color:red" class="" id="errmsg"></span></p> 
            <input id="ControlNo" name="Idnum" placeholder="Enter Control Number" required="" tabindex="1" type="text" value="" autofocus>
            <div class="ControlNo_avail_result" id="ControlNo_avail_result"></div>

            <p class="contact"><label for="Fname1">First Name <font style="color:red"> *</font></label> </label> <span style="color:red" class="" id="errmsgF"></span></p> 
            <input id="Fname1" name="Fname" placeholder="First Name" required="" tabindex="2" type="text" value="<?php if(isset($_SESSION['lname'])) {echo$_SESSION['lname']; } ?>" autofocus> 
            <p class="contact"><label for="Mname1">Middle Name </label><span style="color:red" class="" id="errmsgM"></span></p>
            <input id="Mname1" name="Mname" placeholder="Middle Name" tabindex="3" type="text" value="<?php if(isset($_SESSION['fname'])) {echo $_SESSION['fname']; } ?>"> 
            <p class="contact"><label for="Lname1">Last Name <font style="color:red"> *</font></label> <span style="color:red" class="" id="errmsgL"></span></p>
            <input id="Lname1" name="Lname" placeholder="Last Name"  required="" tabindex="4" type="text" value="<?php if(isset($_SESSION['mname'])) {echo $_SESSION['mname']; } ?>"> 
                                                             
            <p class="contact"><label for="course">Course / Year Level   <font style="color:red"> *</font></label></p> 
            <select class="select-style" name="course" name="course" tabindex="5"  required>
                <option value="">COURSE</option> 
                <?php
                    $result = mysql_query("SELECT * FROM fr_course");

                    while ($row = mysql_fetch_array($result)) 
                    {
                        echo "<option value='".$row['CCode']."'>".$row['CCode'];
                    }
                ?>         
            </select> 
            <select class="select-style" name="year" tabindex="6"  required>
                <option value="">YEAR LEVEL </option>
                <option value="1st Year">1st</option>
                <option value="2nd Year">2nd</option>
                <option value="3rd Year">3rd</option>
                <option value="4th Year">4th</option>
                <option value="5th Year">5th</option>
            </select>

            <p class="contact"></p> 
            <p class="contact"><label for="password">Password</label></p> 
            <input type="input" id="pass" name="pass" placeholder="Password" tabindex="" required="" value="<?php echo $pass; ?>" readonly>
            <p class="contact" style="border: 1px solid gray;Width:400px;"></p> 
            <input class="buttom" name="submit" id="submit" tabindex="7" value="SUBMIT" type="submit"> 
            <a href="javascript:fg_hideform('fg_formStudent','fg_backgroundStudent');"> <input type='button' name='Submit' value='Close' class="buttom" /> </a>
        </form>
    </div>  

    
    </div>
</div>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("Studentform");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Please provide folder name");

    document.forms['Studentform'].refresh_container=function()
    {
        var formpopup = document.getElementById('fg_formStudent');
        var innerdiv = document.getElementById('fg_form_InnerStudent');
        var b = innerdiv.offsetHeight+30+30;

        formpopup.style.height = b+"px";
    }

    document.forms['Studentform'].form_val_onsubmit = document.forms['Studentform'].onsubmit;


    document.forms['Studentform'].onsubmit=function()
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
        var containerobj = document.getElementById('fg_form_InnerStudent');
        var sourceobj = document.getElementById('fg_submit_success_message');
        var error_div = document.getElementById('fg_server_errors');
        var formobj = document.forms['Studentform']

        var submitter = new FG_FormSubmitter("AccountManagement/chckAcct.php",containerobj,sourceobj,error_div,formobj);
        var frm = document.forms['Studentform'];

        submitter.submit_form(frm);
    }

// ]]>
</script>

<div id='fg_backgroundStudent'></div>

<div id='fg_submit_success_message'>
 

        <a href="javascript:fg_hideform('fg_formStudent','fg_backgroundStudent');">Close this window</a>
</div>
