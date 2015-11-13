
    <script type='text/javascript' src='Javascript/scripts/gen_validatorv31.js'></script>
    <script type='text/javascript' src='Javascript/scripts/fg_ajax.js'></script>
    <script type='text/javascript' src='Javascript/scripts/fg_moveable_popup.js'></script>
    <script type='text/javascript' src='Javascript/scripts/fg_form_submitter.js'></script>
    <?php 
        if(isset($_GET['folder']) && $_GET['folder'] != "")
        {
    ?>
    <div id='fg_formUpload'>
        <div id="fg_Upload_header">
            <div id="fg_Upload_Title">UPLOAD</div>
            <div id="fg_Upload_Close"><a href="javascript:fg_hideform('fg_formUpload','fg_backgroundUpload');">Close(X)</a></div>
        </div>

        <div id="fg_form_InnerUpload">
            <?php
             //File uploading
            if($file_uploads == 1 && $listing_mode == 0) 
            { 
            ?>
                <table width="<?PHP echo $table_width; ?>" border="0" cellpadding="2" cellspacing="2" class="table_border">
                    <tr class="top_row">
                        <td>
                            <form action="dirLIST_files/process_upload.php" method="post" enctype="multipart/form-data" name="upload_form" id="upload_form" maxlength="4"> 
                                <input name="file" type="file" id="file" size="40" />
                                <input name="submit" type="submit" id="submit" value="<?PHP echo $local_text['upload']; ?>" />
                                <input name="folder" type="hidden" id="folder" value="<?PHP echo $_GET['folder']; ?>" /><?PHP echo $local_text['filesize_limit']; ?>: <?PHP echo max_upload_size(); ?>
                            </form>
                        </td>
                    </tr>
                </table>

            <?PHP 
            //File uploading -done
            } ?>
        </div>
    </div>
    <!-- client-side Form Validations:
    Uses the excellent form validation script from JavaScript-coder.com-->

    <script type='text/javascript'>
    // <![CDATA[

        var frmvalidator  = new Validator("upload_form");
        frmvalidator.EnableOnPageErrorDisplay();
        frmvalidator.EnableMsgsTogether();
        frmvalidator.addValidation("name","req","Please provide folder name");

        document.forms['upload_form'].refresh_container=function()
        {
            var formpopup = document.getElementById('fg_formUpload');
            var innerdiv = document.getElementById('fg_form_InnerUpload');
            var b = innerdiv.offsetHeight+30+30;

            formpopup.style.height = b+"px";
        }

        document.forms['upload_form'].form_val_onsubmit = document.forms['upload_form'].onsubmit;


        document.forms['upload_form'].onsubmit=function()
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
            var containerobj = document.getElementById('fg_form_InnerUpload');
            var sourceobj = document.getElementById('fg_submit_success_message');
            var error_div = document.getElementById('fg_server_errors');
            var formobj = document.forms['upload_form']

            var submitter = new FG_FormSubmitter("dirLIST_files/process_upload.php",containerobj,sourceobj,error_div,formobj);
            var frm = document.forms['upload_form'];

            submitter.submit_form(frm);
        }

    // ]]>
    </script>

    <div id='fg_backgroundUpload'></div>

    <div id='fg_submit_success_message'>
     

            <a href="javascript:fg_hideform('fg_formUpload','fg_backgroundUpload');">Close this window</a>
    </div>
    <?php
        }
        else {
    ?>
        <div id='fg_formUpload'>
        <div id="fg_Upload_header">
            <div id="fg_Upload_Title">WARNING</div>
            <div id="fg_Upload_Close"><a href="javascript:fg_hideform('fg_formUpload','fg_backgroundUpload');">Close(X)</a></div>
        </div>

        <div id="fg_form_InnerUpload">
            <h2>PLEASE SELECT FOLDER TO UPLOAD</h2>
             
        </div>
    </div>

    <div id='fg_backgroundUpload'></div>

    <div id='fg_submit_success_message'>
     

            <a href="javascript:fg_hideform('fg_formUpload','fg_backgroundUpload');">Close this window</a>
    </div>
    <?
        }
    ?>