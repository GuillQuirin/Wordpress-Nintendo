$(document).ready(function(){
	var fenetre = $(window);
	var header = $("header");
	var footer = $("footer");
	var content = $("#content");

	//TailleHeader(0);
	content.css( "height" , $(window).height()-header.height()-footer.height() );

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

	$(".question").click(function(){
		var li = $(this).parent();
		console.log(li.find(".reponse").slideToggle("slow"));
	});

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

	$('#comments').click(function(){
		$('.commentlist').slideToggle();
	})
});
