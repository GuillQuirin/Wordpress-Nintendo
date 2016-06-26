<?php
	// On commence par récupérer les données utiles aux requêtes
	$date = new Date();
	$year = date('Y');
	$dates = $date->getAll($year);
	global $wpdb;
	$resultats = $wpdb->get_results("SELECT id, post_title, post_content FROM wp_posts");

	if($resultats && is_array($resultats)){
		foreach ($resultats as $evenement){
			// Chaque titre d'évènement est associé à sa date et son ID
			if(strtotime(trim($evenement->post_content))!==FALSE)
				$events[strtotime($evenement->post_content)][$evenement->id] = $evenement->post_title;		
		}
	}

