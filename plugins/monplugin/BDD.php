<?php
	include('Base_donnees.php');
	// On commence par récupérer les données utiles aux requêtes
	$date = new Date();
	$year = date('Y');
	$dates = $date->getAll($year);

	$requete= ('select id,post_title,post_content from wp_posts '); // On selectionne les évènements de l'année courante
	$res= @mysqli_query($cx, $requete);

	$events=array();
	while(($e=mysqli_fetch_array($res))!=false)
	{
		$events[strtotime($e['post_content'])][$e['id']] = $e['post_title']; // Chaque titre d'évènement est associé à sa date et son ID
	}
?>
