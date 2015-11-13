
<script type='text/javascript' src='Javascript/scripts/gen_validatorv31.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_ajax.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_moveable_popup.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_form_submitter.js'></script>

<div id='fg_formSubject'>
    <div id="fg_container_header">
        <div id="fg_box_Title">SEMESTER</div>
        <div id="fg_box_Close"><a href="javascript:fg_hideform('fg_formSubject','fg_backgroundpopup');">Close(X)</a></div>
    </div>

    <div id="fg_form_InnerContainer">
    <div  class="form" >
        <form id='Folder' action="Admin.php?ViewSubj=Subject" method="post"  name="form1" >
            <div class='container'>
                <p class="contact"><label for="subject">Subject Code <font style="color:red"> *</font></label></p>
                <input type="input" id="subject" name="Subject" placeholder="Subject Code" tabindex="" required="" value="" >
                
                <p class="contact"><label for="desc">Description <font style="color:red"> *</font></label></p>
                <input type="input" id="desc" name="desc" placeholder="Description" tabindex="" required="" value="" >
            
                <p class="contact"><label ></label></p> 
                <p class="contact"><label for="">Semester  <font style="color:red"> *</font></label></p> 
                <select class="select-style" name="SemID" tabindex="5"  required>
                    <option value="">SELECT</option> 
                    <?php
                        $result = mysql_query("SELECT * FROM fr_semester");

                        while ($row = mysql_fetch_array($result)) 
                        {
                            echo "<option value='".$row['SemID']."'>".$row['Semester'];
                        }
                    ?>       
                </select>
            </div>
                <p class="contact"><label for="course"></label></p> 
                <input class="buttom"  type='submit' name='Submit' value='Submit' />
                <a href="javascript:fg_hideform('fg_formSubject','fg_backgroundpopup');"> <input class="buttom"  type='button' name='Submit' value='Close' /> </a>
            </div>
        </form>
    </div>
    </div>
</div>

<div id='fg_backgroundpopup'></div>

<div id='fg_submit_success_message'>
 

        <a href="javascript:fg_hideform('fg_formSubject','fg_backgroundpopup');">Close this window</a>
</div>
