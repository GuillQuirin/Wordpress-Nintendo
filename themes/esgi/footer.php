
	</div>
	<footer>
	<?php 
	if(has_nav_menu('foot_menu')){
		wp_nav_menu(array('theme_location' => 'foot_menu'));
	} 
	?>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>