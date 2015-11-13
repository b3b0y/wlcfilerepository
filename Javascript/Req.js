$(document).ready(function()
{
	$("#Lname").change(function () 
	{  
    	$("#uname").val($("#Lname").val() + $("#Cont").val());
	});
});

