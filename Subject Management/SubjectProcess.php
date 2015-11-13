<?php session_start();
include_once("../php/config.php");

	 if(isset($_POST['submit']))
    {
        $result = mysql_query("SELECT * FROM fr_ins_subject WHERE ID = '".$_POST['Subject']."' AND uid = '".$_SESSION['uid']."'")or die ("Student :". mysql_error());
        $row = mysql_fetch_array($result);

        $result1 = mysql_query("SELECT * FROM fr_stud WHERE ControlNo = '".$_POST['ControlNo']."'")or die ("Student :". mysql_error());
        $row1 = mysql_fetch_array($result1);

        $Subject = $row1['ControlNo']."-".$row1['LName']."-".$row['Subject'];
        $path = $row['SubPath']."/".$Subject;


        mysql_query("INSERT INTO fr_stud_subject(ControlNo,Folder_Name,SubPath,Parent_F,Inst_ID) VALUES('".$_POST['ControlNo']."','".$Subject."','".$path."','".$_POST['Subject']."','".$_SESSION['uid']."')");
    	
    	mkdir ($path, 0700);
    }

?>