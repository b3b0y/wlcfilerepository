	$(document).ready(function(){
			var expand = false;
			$("img.menulist").on("click", function(){
				if(!expand){
					$("#menu").animate({
						marginLeft:"0px"
					},"fast", function(){
						expand = true;
					});

					$("#contenido").animate({
						marginLeft:"200px"
					},"fast");
				} else {
					$("#menu").animate({
						marginLeft:"-200px"
					},"fast",function(){
						expand = false;
					});

					$("#contenido").animate({
						marginLeft:"0"
					},"fast");
				}

			});
			$("nav").on("click", "li", function(){
				$("#menu").animate({
						marginLeft:"-200px"
					},"fast",function(){
						expand = false;
					});

					$("#contenido").animate({
						marginLeft:"0"
					},"fast");
				});
			});