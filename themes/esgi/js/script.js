$(document).ready(function(){
	var fenetre = $(window);
	var header = $("header");
	var content = $("#content");

	TailleHeader(1);
	content.css( "padding-top" , header.height() );
	$(".pres").css( "height" , (fenetre.height()/2)-header.height() );

	$(window).scroll(function(){
		console.log(fenetre.scrollTop());
		if(header.attr("status")=="0"){
			if(fenetre.scrollTop() > header.height()/2){
				TailleHeader(0);	
			}
			else{
				TailleHeader(1);
			}
			content.css( "padding-top" , header.height() );
		}
	});

	function TailleHeader(complet){
		header.attr("status","1");
		if(complet) 
			header.animate( {"height" : fenetre.height()/5 }, 400, function(){
				header.attr("status","0");
			}
		);
		else 
			header.animate( {"height" : fenetre.height()/10}, 400, function(){
				header.attr("status","0");
			}
		);

	}

});
