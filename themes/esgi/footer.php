
	</div>
	<footer>
	<?php 
	if(has_nav_menu('secondary')){
		wp_nav_menu(array('theme-location' => 'secondary'));
	} 
	?>
	</footer>
	<?php wp_footer(); ?>
</body>
</html>