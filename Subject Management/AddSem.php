
<script type='text/javascript' src='Javascript/scripts/gen_validatorv31.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_ajax.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_moveable_popup.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_form_submitter.js'></script>

<div id='fg_formSem'>
    <div id="fg_container_header">
        <div id="fg_box_Title">SEMESTER</div>
        <div id="fg_box_Close"><a href="javascript:fg_hideform('fg_formSem','fg_backgroundpopup');">Close(X)</a></div>
    </div>

    <div id="fg_form_InnerContainer">
    <div  class="form" >
        <form id='Folder' action="Admin.php?Sem=Semester" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class='container'>
                <p class="contact"><label ></label></p> 
                <p class="contact"><label for="course">Semester  <font style="color:red"> *</font></label></p> 
                <select class="select-style" name="sem"  tabindex="5"  required>
                    <option value="">SELECT</option> 
                    <option value="1st Semester">1st Semester</option> 
                    <option value="2nd Semester">2nd Semester</option>     
                </select>
               
                <p class="contact"><label ></label></p> 
                
                <p class="contact"><label for="sy">School Year <font style="color:red"> *</font></label></p> 
                <input type="input" id="sy" name="sy" placeholder="School Year" tabindex="" required="" value="" >
                <!--
                <p class="contact"><label for="date">Start Date <font style="color:red"> *</font></label></p> 
                <input type="date" id="date" name="date" tabindex="" required="" value="" >  
                -->
            </div>
                <p class="contact"><label for="course"></label></p> 
                <input class="buttom"  type='submit' name='Submit' value='Submit' />
                <a href="javascript:fg_hideform('fg_formSem','fg_backgroundpopup');"> <input class="buttom"  type='button' name='Submit' value='Close' /> </a>
            </div>
        </form>
    </div>
    </div>
</div>

<div id='fg_backgroundpopup'></div>

<div id='fg_submit_success_message'>
 

        <a href="javascript:fg_hideform('fg_formSem','fg_backgroundpopup');">Close this window</a>
</div>
