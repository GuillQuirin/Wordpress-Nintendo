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
		'foot_menu' => 'Menu secondaire'
		)
	);
}
add_action('init','menus');


/*Load de la zone de widget*/
function sidebars(){
	register_sidebar(array(
		'name' 			=> __('Barre latérale', 'Sidebar'),
		'id' 			=> 'sidebar',
		'before_widget'	=> '<div>',
		'after_widget'	=> '</div>',
		'before_title'	=> '<h3>',
		'after_title'	=> '</h3>',
		'description'	=> __('Widgets in this area will be shown on', '')
	));
}
add_action('widgets_init','sidebars');

/*Load du logo d'en-tete*/
$defaults = array(
	'default-image'          => get_template_directory_uri().'/img/Logo.gif',
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

/*Add post thumbnail*/

function custom_theme_setup(){
	add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'custom_theme_setup');


function init_fields(){
	add_meta_box('id_poste', 'Poste au sein de l\'entreprise', 'id_poste');
}

function id_poste(){
	global $post;
	$custom = get_post_custom($post->ID);
	$id_poste = $custom["id_poste"][0];

	echo '<input type="text" size="70" value="';
		echo $id_poste;
	echo '" name="id_poste">';
	

}
add_action("admin_init", "init_fields");

function save_custom(){
	global $post;
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
		return $postID;
	}
}



/*Ajout de l'onglet Option sup dans l'interface WP*/
function menu_page(){
	add_menu_page('Page d\'accueil',
				   'Page d\'accueil',
				   'administrator',
				   'manage_options',
				   'options_page');
}
add_action('admin_menu', 'menu_page');


/*Champs à remplir dans l'onglet Options sup de l'interface*/
function theme_options(){

	//Enregistrement du texte Description
	register_setting('my_theme', 'description');
	register_setting('my_theme','background');	
	register_setting('my_theme','text-color');
	register_setting('my_theme','header_link');
	register_setting('my_theme','header_link_v');

	//Enregistrement de l'image en banniere
	if(isset($_FILES["img"]) && $_FILES["img"]["error"]!=4)
		enregistrement_fichier($_FILES["img"], "img");

	//Enregistrement du background en banniere
	if(isset($_FILES["bg"]) && $_FILES["bg"]["error"]!=4)
		enregistrement_fichier($_FILES["bg"], "bg");
}

add_action('admin_init','theme_options');

function enregistrement_fichier($fichier, $nomBDD){
	global $wpdb;

	if($fichier["error"] > 0)
		echo "Error: " . $fichier["error"] . "<br>";
	else
	{
		$FileName = str_replace(" ","", $fichier["name"]);

		$url = plugin_dir_path( __FILE__ );
		move_uploaded_file($fichier["tmp_name"], $url .'/img/'. $fichier["name"]);

	}

	$results = $wpdb->get_results("SELECT COUNT(*) as nb FROM wp_options WHERE option_name='".$nomBDD."'");
	
	if($results[0]->nb == 0)
		$wpdb->query("INSERT INTO wp_options (option_name, option_value) VALUES ('".$nomBDD."', '".$FileName."')");
	else	
		$wpdb->query("UPDATE wp_options SET option_value='".$FileName."' WHERE option_name='".$nomBDD."'");
}


/*Config de l'onglet Options sup*/
function options_page(){
	
	echo '<h1>Configuration de la page d\'accueil</h1>';
	echo '<form action="options.php" method="post" enctype="multipart/form-data">';
			
		settings_fields('my_theme');

		echo '<label><h3>Description du site:</h3>'
				.'<textarea name="description" id="banniere_desc">'.get_option('description').'</textarea>'
			.'</label>';

		echo '<label><h3>Couleur de fond:</h3>'
				.'<input type="color" name="background" value='.get_option('background').'>'
			.'</label>';

		echo '<label><h3>Couleur du texte:</h3>'
				.'<input type="color" name="text-color" value='.get_option('text-color').'>'
			.'</label>';

		echo '<label><h3>Couleur des liens des menus:</h3>'
				.'<input type="color" name="header_link" value='.get_option('header_link').'>'
			.'</label>';

		echo '<label><h3>Couleur des liens ciblés (:hover) des menus:</h3>'
				.'<input type="color" name="header_link_v" value='.get_option('header_link_v').'>'
			.'</label>';

		echo '<h3>Image de bannière</h3>';
		echo '<label for="label_img">';
			echo '<img id="banniere_img" src="'.get_template_directory_uri().'/img/'.get_option("img").'">';
			echo '<input id="label_img" name="img" type="file">';
		echo '</label>';

		echo '<h3>Fond d\'écran de la bannière</h3>';
		echo '<label for="label_bg">';
			echo '<img id="banniere_bg" src="'.get_template_directory_uri().'/img/'.get_option("bg").'">';
			echo '<input id="label_bg" name="bg" type="file">';
		echo '</label>';

		echo '<input id="banniere_submit" value="Mettre à jour" type="submit">';

	echo '</form>';
}

function admin_css() {

$admin_handle = 'admin_css';
$admin_stylesheet = get_template_directory_uri() . '/custome-editor-style.css';

wp_enqueue_style( $admin_handle, $admin_stylesheet );
}
add_action('admin_print_styles', 'admin_css', 11 );



function wp_after_body() {  
 do_action('wp_after_body');
}

function contenu_description() {
	
	echo "<img id='banniere_bg' src='".get_template_directory_uri()."/img/". get_option('bg')."'>";

	echo "<div id='banniere'>";
		echo "<div id='banniere_img'><img src='".get_template_directory_uri()."/img/". get_option('img')."'></div>";
		echo "<div id='banniere_desc'>".get_option('description')."</div>";
	echo "</div>";
}

add_action( 'wp_after_body', 'contenu_description' );


/*Chargement des parametres envoyés par Options sup dans la BDD*/
function head_style(){
	echo '<meta name="viewport" content="width=device-width" />';
	echo '<style>'
		.'#content{'
			.'background-color:'
			.get_option('background').';'	
			.'color:'
			.get_option('text-color').';}'
		.'header a, footer a{'
			.'color:'
			.get_option('header_link').';}'
		.'header a:hover, footer a:hover{'
			.'color:'
			.get_option('header_link_v').';}'
		.'</style>';
}
add_action('wp_head','head_style');


/*Load du JQuery*/
function my_custom_jquery() {
    wp_enqueue_script(
        'jQuery',
        get_template_directory_uri() . '/js/jquery.js'
    );
}
add_action('wp_enqueue_scripts', 'my_custom_jquery');


/*Load du script.js*/
wp_register_script( 'script', get_template_directory_uri().'/js/script.js', 'jQuery');



/* Creation d'un widget */
function my_widgets(){

	//Widget du prochain evenement
	include_once plugin_dir_path(__FILE__).'event.php';	
		register_widget('Evenement');
	
	//Shortcode des dernieres infos
	include_once plugin_dir_path(__FILE__).'recent.php';
		new Zero_Recent();	
}

add_action('widgets_init', 'my_widgets');

/*Creation d'un nouveau type de contenu*/

add_action('init', 'newcustomposttype');

function newcustomposttype(){
	register_post_type('games', 
		array(
			'labels' => array(
				'name' => __('Jeux'),
				'singular_name' => __('Jeu')
				),
		'public' => true,
		'has_archive' =>true,
		'menu_position' => 4,
		'supports' => array(
			'title',
			'thumbnail',
			'revisions'
			)
		)
	);
}

/* Shortcode */

add_shortcode('Calendrier','calendrierplug');

/* CSS pour le Back */

function editorstyle(){
	add_editor_style('custome-editor-style.css');
}

add_action('after_setup_theme','editorstyle');

/* Formatage de texte */

function editor_tinymce($init_formats){
	$style_formats = array(
		array(
			 'title' => '.translation',
			 'block' => 'blockquote',
			 'classes' => 'translation',
			 'wrapper' => true
			),
		array(
			 'title' => '.rtl',
			 'block' => 'blockquote',
			 'classes' => 'rtl',
			 'wrapper' => true
			),
		array(
			 'title' => '.translation',
			 'block' => 'blockquote',
			 'classes' => 'translation',
			 'wrapper' => true
			)
	);

	$init_formats['style_formats'] = json_encode($style_formats);
	return $init_formats;
}

add_filter('tiny_mce_before_init','editor_tinymce');



