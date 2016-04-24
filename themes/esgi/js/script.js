$(document).ready(function(){
	var fenetre = $(window);
	var header = $("header");

	header.css( "height" , fenetre.height()/20 );
	$(".pres").css( "height" , (fenetre.height()/2)-header.height() );
});