jQuery(function($) {
	var cnt = $("a[id^=click]").length;
	var cnt2 = $("a[id^=clickf]").length;
	var ctr = $("li[id^=high]").length;
	var  arr = [];
	//FOLDER
	for ( var i = 0; i < ctr; i++ ) 
	{
	    var $thumbs =  $('#click'+i+'').click(function(e) {
			    e.preventDefault();
				   // $thumbs.removeClass("highlight");
				   // $('li#high'+i+'').addClass("highlight");
				    //alert('li#high'+i+'');
	        return false;
	    }).dblclick(function() {
	        window.location = this.href;
	        return false;
	    });
    }

    //FILES
    for ( var j = 0; j < cnt2; j++ ) 
	{
	    $('#clickf'+j+'').click(function() {
	        return false;
	    }).dblclick(function() {
	        window.location = this.href;
	        return false;
	    });
    }

    //FILE TREE
    for ( var l= 0; l < cnt; l++ ) 
	{
	    $('#fclick'+l+'').click(function() {
	        return false;
	    }).dblclick(function() {
	        window.location = this.href;
	        return false;
	    });
    }

});

             


