$(document).ready(function(){
	$('#username').keyup(function(){ // Keyup function for check the user action in input
		var Username = $(this).val(); // Get the username textbox using $(this) or you can use directly $('#username')
		var UsernameAvailResult = $('#username_avail_result'); // Get the ID of the result where we gonna display the results
			if(Username.length > 5) { // check if greater than 2 (minimum 3)
				UsernameAvailResult.html('Loading..'); // Preloader, use can use loading animation here
				var UrlToPass = 'action=username_availability&username='+Username;
				$.ajax({ // Send the username val to another checker.php using Ajax in POST menthod
				type : 'POST',
				data : UrlToPass,
				url  : 'php/checker.php',
				success: function(responseText){ // Get the result and asign to each cases
					if(responseText == 0){
						UsernameAvailResult.html('<span class="success">Username name available</span>');
					}
					else if(responseText > 0){
						UsernameAvailResult.html('<span class="error">Username already taken</span>');
					}
					else{
						alert('Problem with sql query='+Username);
					}
				}
				});
			}else{
				UsernameAvailResult.html('<span class="error"> Enter atleast 6 characters </span>');
			}
			if(Username.length == 0) {
				UsernameAvailResult.html('');
			}
		
	});

	$('#ControlNo').keyup(function(){ // Keyup function for check the user action in input
		var Username = $(this).val(); // Get the username textbox using $(this) or you can use directly $('#username')
		var UsernameAvailResult = $('#ControlNo_avail_result'); // Get the ID of the result where we gonna display the results
			if(Username.length > 0) { // check if greater than 2 (minimum 3)
				UsernameAvailResult.html('Loading..'); // Preloader, use can use loading animation here
				var UrlToPass = 'action1=ControlNo_availability&ControlNo='+Username;
				$.ajax({ // Send the username val to another checker.php using Ajax in POST menthod
				type : 'POST',
				data : UrlToPass,
				url  : 'php/checker.php',
				success: function(responseText){ // Get the result and asign to each cases
					if(responseText == 0){
						UsernameAvailResult.html('<span class="success">Username name available</span>');
					}
					else if(responseText > 0){
						UsernameAvailResult.html('<span class="error">Username already taken</span> <br>');
					}
					else{
						alert('Problem with sql query='+Username);
					}
				}
				});
			}else{
				UsernameAvailResult.html('<span class="error"> Enter atleast 1 characters </span>');
			}
			if(Username.length == 0) {
				UsernameAvailResult.html('');
			}
		
	});

	$('#password').keyup(function() { // As same using keyup function for get user action in input
		var PasswordLength = $(this).val().length; // Get the password input using $(this)
		var PasswordStrength = $('#password_strength'); // Get the id of the password indicator display area
		
		if(PasswordLength <= 0) { // Check is less than 0
			PasswordStrength.html(''); // Empty the HTML
			PasswordStrength.removeClass('normal weak strong verystrong'); //Remove all the indicator classes
		}
		if(PasswordLength > 0 && PasswordLength < 4) { // If string length less than 4 add 'weak' class
			PasswordStrength.html('weak');
			PasswordStrength.removeClass('normal strong verystrong').addClass('weak');
		}
		if(PasswordLength > 4 && PasswordLength < 8) { // If string length greater than 4 and less than 8 add 'normal' class
			PasswordStrength.html('Normal');
			PasswordStrength.removeClass('weak strong verystrong').addClass('normal');			
		}	
		if(PasswordLength >= 8 && PasswordLength < 12) { // If string length greater than 8 and less than 12 add 'strong' class
			PasswordStrength.html('Strong');
			PasswordStrength.removeClass('weak normal verystrong').addClass('strong');
		}
		if(PasswordLength >= 12) { // If string length greater than 12 add 'verystrong' class
			PasswordStrength.html('Very Strong');
			PasswordStrength.removeClass('weak normal strong').addClass('verystrong');
		}
	});
	
	$('#repassword').keyup(function() { // As same using keyup function for get user action in input
		var PasswordLength = $(this).val(); // Get the password input using $(this)
		var PasswordStrength = $('#repassword_strength'); // Get the id of the password indicator display area
		
		if(PasswordLength == "") { // Check is less than 0
			PasswordStrength.html(''); // Empty the HTML
			PasswordStrength.removeClass('Empty'); //Remove all the indicator classes
		}
		else if(PasswordLength == $('#password').val()) 
		{ // If password match
			PasswordStrength.html('Password Confirm');
			PasswordStrength.removeClass('Password Confirm').addClass('match');	
		}
		else
		{
			PasswordStrength.html('<span class="error">Password not match</span> <br>');
			PasswordStrength.removeClass('Password not match').addClass('notmatch');
		}	
	});
});