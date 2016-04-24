<?php
//Chargement du HEADER
get_header();

if(is_home()){
	echo '<h1>C EST UN HOME</h1>';
	?>
	<div class="pre">
		<?php
		if(have_posts()){

			//Nouvelle requête Wordpress
			$requete = new WP_Query();

			//Selection des articles uniquement mis en avant
			$enavant = get_option('sticky_posts');
			$args = array(
				'showposts' => 3,
				'post__in' => $enavant,
				'caller_get_posts' => 1,
				'orderby' => 'date',
			);

			//Execution de la boucle
			$requete->query($args);
			while ($requete->have_posts()) : $requete->the_post();

				//Affichage de l'article
				echo "<p>".the_title()."</p>";
					the_content();
				echo "<br>";
			
			endwhile; 
		}
		else{
			echo "<p>"._e('Sorry, no posts matched your criteria.','esgi')."</p>";
		}
		?>
	</div>
	<?php
}

//CHARGEMENT DU FOOTER
get_footer();