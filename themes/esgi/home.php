<?php
//Chargement du HEADER
get_header();

if(is_home()){
	echo '<div>C EST UN HOME</div>';

	wp_after_body();
	
	if(have_posts()){
		get_option('description');
		//Nouvelle requête Wordpress
		$requete = new WP_Query();

		//Selection des articles uniquement mis en avant
		$enavant = get_option('sticky_posts');
		$args = array(
			'showposts' => 2,
			'post__in' => $enavant,
			'caller_get_posts' => 1,
			'order' => 'ASC',
			'orderby' => 'ID',
		);

		//Execution de la boucle
		$requete->query($args);
		while ($requete->have_posts()) : $requete->the_post();
			echo "<div class='pres'>";
				//Affichage de l'article
				echo "<p>".the_title()."</p>";
					the_content();
				echo "<br>";
			echo "</div>";
		endwhile; 
	}
	else{
		echo "<p>"._e('Sorry, no posts matched your criteria.','esgi')."</p>";
	}
}

//CHARGEMENT DU FOOTER
get_footer();