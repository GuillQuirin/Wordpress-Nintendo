<?php

/*Load du css*/
function include_styles_scripts(){
	wp_enqueue_style('style-name',get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'include_styles_scripts');


/*Load du menu*/
function menus(){
	register_nav_menus(array(
		'main_menu' => 'Menu principal',
		'secondary_menu' => 'Menu secondaire'
		)
	);
}

add_action('init','menus');


/*Load de la zone de widget*/

function sidebars(){
	register_sidebar(array(
		'name' 			=> __('Main Sidebar', 'esgi'),
		'id' 			=> 'sidebar-1',
		'before_widget'	=> '<div>',
		'after_widget'	=> '</div>',
		'description'	=> __('Widgets in this area will be shown on', '')
	));
}

add_action('widgets_init','sidebars');

/*Logo d'en-tete*/

$defaults = array(
	'default-image'          => get_template_directory_uri().'/img/tumblr.jpg',
	'random-default'         => false,
	'width'                  => 0,
	'height'                 => 0,
	'flex-height'            => false,
	'flex-width'             => false,
	'default-text-color'     => '',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
);

add_theme_support( 'custom-header', $defaults );


/*Page admin*/

function menu_page(){
	add_menu_page('Options supplementaires','Options sup','administrator','manage_options','options_page');
}

add_action('admin_menu', 'menu_page');

function theme_options(){
	register_setting('my_theme', 'background');
	register_setting('my_theme','text_color');
}

add_action('admin_init','theme_options');

function options_page(){
	echo '<h1>Ma page d\'options</h1>'
		.'<form action="options.php" method="post">';
		settings_fields('my_theme');

		echo '<label>Background'
		.'<input value="'.get_option('background').'" name="background" type="text">'
		.'</label><label>Text'
		.'<input value="'.get_option('text_color').'" name="text_color" type="text">'
		.'</label><input value="Mettre à jour" type="submit">'
		.'</form>';
}


function head_style(){
	echo '<style>'
		.'body{'
			.'background-color:'. get_option('background').';'
			.'color:'
		.get_option('text_color').'}'
		.'</style>';
}

add_action('wp_head','head_style');



/* Creation d'un widget */

function my_widgets(){
	register_widget('link_custom');	
}

add_action('widgets_init', 'my_widgets');

class link_custom extends WP_Widget{
	function link_custom(){
		parent::__construct(false, 'Lien personnalise');
		$options = array(
			'classname' => 'link-custom',
			'description' => 'ceci est notre premier widget'
			);
		$this->WP_Widget('link-custom','Lien personnalisé',$options);
	}
	function widget($instance){
		echo '<a href="'.$instance['url'].'">'.$instance['name'].'</a>';
	}
	function update($new_instance, $old_instance){
		return $new_instance;
	}
	function form($instance){
		$params = array(
			'url' => 'http://google.com',
			'name' => 'Google'
		);
		$instance = wp_parse_args($instance,$params);
		echo '<label>URL du lien</label>'
			.'<input type="text" id="'.$this->get_field_id('url').'" name="'.$this->get_field_id('url').'" value="'.$instance['url'].'">'
			.'<label>Titre du lien</label>'
			.'<input type="text" id="'.$this->get_field_id('name').'" name="'.$this->get_field_id('name').'" value="'.$instance['name'].'">';
	}
}
