<div  class="form" > 
    <form name="contactform" id="contactform" method="post" action="Subject Management/SubjectProcess.php"> 
        <p class="contact">Legend:<font style="color:red;" size="5px">  * </font> - Required field </p>
        
        <p class="contact" style="border: 1px solid gray;Width:400px;"></p> 

        <p class="contact"><label for="ControlNo">Student ID  <font style="color:red;"> *</font></label></p>
        <select class="select-style" name="ControlNo" id="ControlNo" required>
            <option Selected value="">PLEASE SELECT
            <?php
                $result = mysql_query("SELECT * FROM fr_stud");
                if(mysql_num_rows($result) > 0)
                {
                    while ($row = mysql_fetch_array($result)) {
            ?>
                    <option value="<?php echo $row['ControlNo']; ?>"><?php echo $row['ControlNo']; ?>
            <?php
                    }
                }
            ?>
        </select>
         <p class="contact"> &nbsp </p>
        <p class="contact"><label for="Subject">Subject  <font style="color:red;"> *</font></label></p>
        <select class="select-style" name="Subject" id="Subject" required>
            <option Selected value="">PLEASE SELECT
            <?php
                $result = mysql_query("SELECT * FROM  fr_ins_subject WHERE uid = '".$_SESSION['uid']."'");
                if(mysql_num_rows($result) > 0)
                {
                    while ($row = mysql_fetch_array($result)) {
            ?>
                    <option value="<?php echo  $row['ID']; ?>"><?php echo  $row['Subject']; ?>
            <?php
                    }
                }
            ?>
        </select>
       <p class="contact"> &nbsp </p> 
        <center>
             <input class="buttom" name="submit" id="submit" tabindex="7" value="SUBMIT" type="submit">  
        </center>
    </form>
</div> 

