<?php
get_header();

if(is_home()){
	echo '<h1>C EST UN HOME</h1>';

	//Presentation
	if(have_posts()){
		if($a = get_post(34)):
			echo '<div id="presentation">';
				the_post();
				the_content();
			echo '</div>';
		endif;
	}
	if(have_posts()){
		while(have_posts()):
			the_post();
			?>
			<h3><?php the_title(); ?></h3>
			<?php 
			$excerpt = get_the_excerpt();
			$content = get_the_content();
			if($excerpt != $content){
				the_excerpt();
				$link = get_permalink();
				echo '<a href="'.$link.'">Lien vers l\'article</a>';
			}
			else{
				the_content('Lire la suite');
			}
		endwhile;
	}
	else{
		?><p>
		<?php _e('Sorry, no posts matched your criteria.','esgi');?>
		</p><?php
	}
}

if(is_active_sidebar('sidebar-1')){
	dynamic_sidebar('sidebar-1');
}

get_footer();