<script type='text/javascript' src='Javascript/scripts/gen_validatorv31.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_ajax.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_moveable_popup.js'></script>
<script type='text/javascript' src='Javascript/scripts/fg_form_submitter.js'></script>
<div id='fg_formSubject'>
    <div id="fg_Subject_header">
        <div id="fg_Subject_Title">Create Group</div>
        <div id="fg_Subject_Close"><a href="javascript:fg_hideform('fg_formSubject','fg_backgroundSubject');">Close(X)</a></div>
    </div>

    <div id="fg_form_InnerSubject">
    <form id='Folder' action='FileManagement/process_subject.php' method='post' accept-charset='UTF-8'>
    <div class='container'>
        <label for='name' >Enter Group name: </label><br/>
        <input type='text' name='file' id='name' value='' maxlength="50" /><br/>
        <input name="folder" type="hidden" id="folder" value="<?PHP echo $_GET['folder']; ?>" />
        <span id='contactus_name_errorloc' class='error'></span>
    </div>
  

    <div class='container'>
        <input type='submit' name='Submit' value='Submit' />
        <a href="javascript:fg_hideform('fg_formSubject','fg_backgroundSubject');"> <input type='button' name='Submit' value='Close' /> </a>
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
        var formpopup = document.getElementById('fg_formSubject');
        var innerdiv = document.getElementById('fg_form_InnerSubject');
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
        var containerobj = document.getElementById('fg_form_InnerSubject');
        var sourceobj = document.getElementById('fg_submit_success_message');
        var error_div = document.getElementById('fg_server_errors');
        var formobj = document.forms['Folder']

        var submitter = new FG_FormSubmitter("popup-contactform.php",containerobj,sourceobj,error_div,formobj);
        var frm = document.forms['Folder'];

        submitter.submit_form(frm);
    }

// ]]>
</script>

<div id='fg_backgroundSubject'></div>

<div id='fg_submit_success_message'>
 

        <a href="javascript:fg_hideform('fg_formSubject','fg_backgroundSubject');">Close this window</a>
</div>
