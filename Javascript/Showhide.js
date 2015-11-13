
$(document).ready(function() {
    toggleFields(); //call this first so we start out with the correct visibility depending on the selected form values
   //this will call our toggleFields function every time the selection value of our underAge field changes
    $("#Ulevel").change(function() { toggleFields(); });
});
//this toggles the visibility of our parent permission fields depending on the current selected value of the underAge field
function toggleFields()
{
    if ($("#Ulevel").val() == 1)
    {
        $("#show").show();
        $("#All").hide();
    }
   	else if($("#Ulevel").val() > 1)
   	{
   		 $("#All").show();
   		  $("#show").hide();
   	}
    else
    {
        $("#show").hide();
        $("#All").hide();
    }
}
