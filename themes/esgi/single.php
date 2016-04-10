<?php
get_header();

echo '<h1>C EST UN SINGLE</h1>';
if(have_posts()){
	while(have_posts()):
		the_post();
		?>
		<article class="post">
			<h1><?php the_title(); ?></h1>
			<div><?php the_content(); ?> </div>
			<?php
			comments_template();
			comment_form();
			?>
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

if(is_active_sidebar('sidebar-1')){
	dynamic_sidebar('sidebar-1');
}

get_footer();