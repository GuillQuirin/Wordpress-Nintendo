<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(); ?></title>
	<?php
		wp_head();
		wp_enqueue_script( 'script' );
	?>
</head>
<body>
	<header status="0">
		<div id="header">
			<div id="logo">
				<a href="<?php echo home_url( '/' ); ?>" title="HOME" ><img src="<?php header_image();?>"></a>
				<p id="slogan"><?php bloginfo('description'); ?></p>
			</div>
			<?php 
			if(has_nav_menu('main_menu')):
				wp_nav_menu(array('theme-location' => 'main_menu'));
			endif;
			?>
		</div>
	</header>
	<div id="content">
	<?php
		if(!is_home()){
			if(is_active_sidebar('sidebar-1')){
				echo '<aside>';
				dynamic_sidebar('sidebar-1');
				echo '</aside>';
			}
			if(is_active_sidebar('sidebar-2')){
				echo '<aside>';
				dynamic_sidebar('sidebar-2');
				echo '</aside>';
			}
		}
	?>