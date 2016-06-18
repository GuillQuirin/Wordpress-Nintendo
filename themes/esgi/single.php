<?php
get_header();

if(have_posts()){
	while(have_posts()):
		the_post();
		?>
		<article class="post single contenu">
			<h1 id='title_single'><?php the_title(); ?></h1>
			<div id='content_single'><?php the_content(); ?> </div>
			<?php
			$custom = get_post_custom($post->ID);
			$content = $custom['id_poste'][0];
			if($content){
				echo $content;
			}
			comments_template();
			?>
		</article>
		<div id='image_single'>
			<?php the_post_thumbnail(); ?>	
		</div>

		<?php
	endwhile;
}
else{
	?>
	<p>
	<?php _e('Sorry, no posts matched your criteria.');?>
	</p>
	<?php
}

if(is_active_sidebar('sidebar')){
	echo "<div id='sidebar'>";
		echo "<ul>";
			dynamic_sidebar('sidebar');	
		echo "</ul>";
	echo "</div>";
}

get_footer();