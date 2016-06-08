<?php
get_header();


if(is_active_sidebar('sidebar')){
	echo "<div id='sidebar'>";
		echo "<ul>";
		dynamic_sidebar('sidebar');	
		echo "</ul>";
	echo "</div>";
}
if(have_posts()){

	while(have_posts()):
		the_post();
		?>
		<article class="post">
			<h1><?php the_title(); ?></h1>
			<div><?php the_content(); ?> </div>
			<ol>
				<?php wp_list_comments(); ?>
			</ol>
		</article>
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


get_footer();

	// echo "<section>";

	// //Articles non mis en avant
	// $args = (array('numberposts' => '5'));
	// $recent_posts = get_posts($args);
	// foreach ($recent_posts as $post) : setup_postdata($post); ?>
	<!-- // 	<article class="post">
	// 		<a href="<?php the_permalink(); ?>"><h1><?php the_title(); ?></h1></a>
	// 		<div><?php the_content(); ?> </div>
	// 	</article> -->
	// <?php 
	// 	endforeach; 
	// 	wp_reset_postdata();
	
	// echo "</section>";