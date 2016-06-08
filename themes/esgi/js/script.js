$(document).ready(function(){
	var fenetre = $(window);
	var header = $("header");
	var content = $("#content");

	TailleHeader(0);
	content.css( "padding-top" , header.height() );
	content.css( "padding-bottom" , header.height() );

	// $(window).scroll(function(){
	// 	console.log(fenetre.scrollTop());
	// 	if(header.attr("status")=="0"){
	// 		if(fenetre.scrollTop() > header.height()/2){
	// 			TailleHeader(0);	
	// 		}
	// 		else{
	// 			TailleHeader(1);
	// 		}
	// 	}
	// });

	function TailleHeader(complet){
		header.attr("status","1");
		if(complet) 
			header.animate( {"height" : fenetre.height()/5 }, 400, function(){
				header.attr("status","0");
			}
		);
		else 
			header.animate( {"height" : fenetre.height()/8}, 400, function(){
				header.attr("status","0");
			}
		);

	}

});
