<?php
get_header();

if(is_home()){
	if(have_posts()){
		while(have_posts()){
			the_post();?>
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
		}
	}
	else{
		?><p>
		<?php _e('Sorry, no posts matched your criteria.','esgi');?>
		</p><?php
	}
}else{
	if(have_posts()){
		while(have_posts()){
			the_post();?>
			<h1><?php the_title(); ?></h1>
			<?php the_content();
		}
	}
	else{
		?><p>
		<?php _e('Sorry, no posts matched your criteria.');?>
		</p><?php
	}
}

get_footer();