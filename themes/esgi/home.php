<?php
//Chargement du HEADER
get_header();

if(is_home()){

	wp_after_body();
	
	if(have_posts()){
		//Nouvelle requête Wordpress
		$requete = new WP_Query();

		//Selection des articles uniquement mis en avant
		$enavant = get_option('sticky_posts');
		$nb_article = (get_option('nb_avant')!==null && get_option('nb_avant')!=0) ? get_option('nb_avant') : 4;

		$args = array(
			'showposts' => $nb_article,
			'post__in' => $enavant,
			'caller_get_posts' => 1,
			'order' => 'ASC',
			'orderby' => 'ID',
		);
		
		//Affichage seulement pour les articles en avant
		if(!empty($enavant)){
			echo "<section id='news'>";
				//Execution de la boucle
				$requete->query($args);
				$cpt=0;
				while ($requete->have_posts()) : $requete->the_post();
					echo ($cpt==0) ? "<article class='pres-0'>" : "<article class='pres'>";
						//Affichage de l'article
						 the_title();
							if($cpt==0) the_content();
						echo "<br>";
					echo "</article>";
					$cpt++;
				endwhile; 
			echo "</section>";
		}
	}
	else{
		echo "<p>"._e('Sorry, no posts matched your criteria.','esgi')."</p>";
	}
}

//CHARGEMENT DU FOOTER
get_footer();