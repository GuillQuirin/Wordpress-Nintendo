<?php

/* APPARENCE DU SITE */

//Load du css

	function include_styles_scripts(){
		wp_enqueue_style('style-name',get_stylesheet_uri());
	}
	add_action('wp_enqueue_scripts', 'include_styles_scripts');


//Load du menu
	function menus(){
		register_nav_menus(array(
			'main_menu' => 'Menu principal',
			'foot_menu' => 'Menu secondaire'
			)
		);
	}
	add_action('init','menus');

//Load de la zone de widget
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


//Load du logo d'en-tete
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


// Interface d'administration
if(is_admin()){
	get_template_part('functions-admin');
}
else{
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

	function wp_after_body() {  
	 do_action('wp_after_body');
	}

	function contenu_description() {
		echo "<div class='parallax' style='background-image:url(".get_template_directory_uri()."/img/".get_option('bg').")'></div>";
		echo "<div id='banniere'>";
			echo "<div id='banniere_img'><img src='".get_template_directory_uri()."/img/". get_option('img')."'></div>";
			echo "<div id='banniere_desc'>".get_option('description')."</div>";
		echo "</div>";
	}

	add_action( 'wp_after_body', 'contenu_description' );
}



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
				'singular_name' => __('Jeu'),
				'all_items' => 'Tous les jeux',
				'add_new_item' => 'Ajouter un jeu',
				'edit_item' => 'Modifier un jeu',
				'new_item' => 'Nouveau jeu',
				'view_item' => 'Voir le jeu',
				'search_item' => 'Rechercher parmi les jeux',
				'not_found' => 'Pas de jeu trouvé'
				),
		'public' => true,
		'capability_type' => 'post',
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

add_action('init', 'newevent');

function newevent(){
	register_post_type('evenement',
		array(
			'labels' => array(
				'name' => __('Events'),
				'singular_name' => __('Event'),
				'all_items' => 'Tous les events',
				'add_new_item' => 'Ajouter un event',
				'edit_item' => 'Modifier un event',
				'new_item' => 'Nouveau event',
				'view_item' => 'Voir le jeu',
				'search_item' => 'Rechercher parmi les events',
				'not_found' => 'Pas de event trouvé'
			),
			'public' => true,
			'capability_type' => 'post',
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


function listedesjeux(){
    $args = array(
        'post_type' => 'games',
        'post_status' => 'publish'
    );

    $string = '';
    $query = new WP_Query( $args );
    if( $query->have_posts() ){
        $string .= '<ul id="listJeux">';
        while($query->have_posts()){
            $query->the_post();
            $string .= '<li>';
            	$string .= get_the_post_thumbnail( );
            	$string .= '<span class="nomJeu">'.get_the_title().'</spn>';
            $string .= '</li>';
        }
        $string .= '</ul>';
    }
    wp_reset_postdata();
    return $string;
}

/* Shortcode */

add_shortcode('ListGames','listedesjeux');
add_shortcode('Calendrier','calendrierplug');



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

add_action( "after_switch_theme", "esgi_creer_tables" );

function esgi_creer_tables() {
	global $wpdb;
	$nom_table = $wpdb->prefix . 'events';
	$sql = "CREATE TABLE $nom_table (
     id bigint(20) unsigned NOT NULL auto_increment,
     description varchar(50) NOT NULL,
     date date NULL,
      PRIMARY KEY  (id)
   );";
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}

