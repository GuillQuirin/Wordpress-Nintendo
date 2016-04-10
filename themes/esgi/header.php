<!DOCTYPE html>
<html>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<title><?php wp_title(); ?></title>
	<?php wp_head(); ?>
</head>
<body>
	<header>
		<a href="<?php echo home_url( '/' ); ?>" title="HOME" ><img src="<?php header_image();?>"></a>
		<?php 
		if(has_nav_menu('main_menu')):
			wp_nav_menu(array('theme-location' => 'main_menu'));
		endif;
		?>
		<p id="slogan"><?php bloginfo('description'); ?></p>
	</header>

	<div id="content">