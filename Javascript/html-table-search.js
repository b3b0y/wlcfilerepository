(function($){
	
	$.fn.tableSearch = function(options){
		if(!$(this).is('table')){
			return;
		}
		//var tableObj = $(this),
			//divObj = $('<label>Search: </label>'),
			inputObj = $('<input class="form-control" type="text" />');
		$("input#form-control").off('keyup').on('keyup', function(){
			var searchFieldVal = $(this).val();
			$("table").find('tbody tr').hide().each(function(){
				var currentRow = $(this);
				currentRow.find('td').each(function(){
					if($(this).html().indexOf(searchFieldVal)>-1 ){
						currentRow.show();
						return false;
					}
				});
			});
		});
		//tableObj.before(divObj.append(inputObj));
	}


}(jQuery));
