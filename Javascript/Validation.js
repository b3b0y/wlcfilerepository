$(document).ready(function(){
	$('#password, #username').keydown(function(e) { // Dont allow users to enter spaces for their username and passwords
		if (e.which == 32) {
			return false;
  		}
	  	
	});
	$('#ControlNo').keydown(function(e) { // Dont allow users to enter spaces , letters for their Controlnumber
		if (e.which == 32) {
			return false;
  		}
	  	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) 
	  	{
	        $("#errmsg").html("Digit Only").show().fadeOut("slow");
	        return false;
	    }
	});

	$('#Fname1, #Fname').keydown(function(e) { // Dont allow users to enter Digits for their Firstname
	  	if (e.which == 32) {
			return true;
  		}
  		if (e.which == 9) {
			return true;
  		}
	  	if (e.which != 8 && e.which != 0 && (e.which < 65 || e.which > 90)) 
	  	{
	  		$("#errmsgF").html("Letters Only").show().fadeOut("slow");
	        return false;
	    }
	});
	$('#Mname1, #Mname').keydown(function(e) { // Dont allow users to enter Digits for their Middle Name
	  	if (e.which == 9) {
			return true;
  		}
	  	if (e.which != 8 && e.which != 0 && (e.which < 65 || e.which > 90)) 
	  	{
	  		$("#errmsgM").html("Letters Only").show().fadeOut("slow");
	        return false;
	    }
	});
	$('#Lname1, #Lname').keydown(function(e) { // Dont allow users to enter Digits for their Last Name
	  	if (e.which == 9) {
			return true;
  		}
	  	if (e.which != 8 && e.which != 0 && (e.which < 65 || e.which > 90)) 
	  	{
	  		$("#errmsgL").html("Letters Only").show().fadeOut("slow");
	        return false;
	    }
	});


	$('#repassword').keydown(function(e) { // Dont allow users to enter spaces for passwords
		if (e.which == 32) {
			return false;
  		}
	});
});