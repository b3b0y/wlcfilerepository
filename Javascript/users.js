//STUDENT

function setApproveSubject() 
{
	document.frmUser.action = "Subject Management/approveprocess.php";
	document.frmUser.submit();
}

function setDisapproveSubject() 
{
	if(confirm("Are you sure want to Disapprove these accounts?")) 
	{
		document.frmUser.action = "";
		document.frmUser.submit();
	}
}

function setUpdateStud() 
{
	document.frmUser.action = "Edit.php";
	document.frmUser.submit();
}

function setEnrollSub() 
{
	document.frmUser.action = "Subject Management/processenroll.php";
	document.frmUser.submit();
}

function setEnrollSubInst() 
{
	document.frmUser.action = "Subject Management/processInsSub.php";
	document.frmUser.submit();
}

function setDeactivateStud() 
{
	if(confirm("Are you sure want to Deactivate these accounts?")) 
	{
		document.frmUser.action = "Admin/admin_deactivateStud.php";
		document.frmUser.submit();
	}
}

//STAFF

function setDeactivateStaff() 
{
	if(confirm("Are you sure want to Deactivate these accounts?")) 
	{
		document.frmUser.action = "Admin/admin_deactivateStaff.php";
		document.frmUser.submit();
	}
}


function setUpdateStaff() 
{
	document.frmUser.action = "SupplyUpdateUser.php";
	document.frmUser.submit();
}

function EnableDisAble(){
if (document.getElementById("chkAgree").checked == true)
document.getElementById("btnSubmit").disabled = false;
else
document.getElementById("btnSubmit").disabled = true;
}