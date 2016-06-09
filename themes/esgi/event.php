<?php 

class Evenement extends WP_Widget{
	
	public function __construct(){
		parent::__construct('next-event', 'Evenement à venir', array('description' => 'Prochain évènement.'));
	}
	
	function widget($args, $instance){
		echo $args['before_widget'];
		
		global $wpdb;

		$results = $wpdb->get_results("SELECT e.id, e.title, e.date 
										FROM events e 
										WHERE e.date>DATE_FORMAT( NOW(), '%Y-%m-%d' ) 
										ORDER BY e.date ASC 
										LIMIT 0,1 ");

		echo '<h3>Prochain Evenement</h3>';
		
		setlocale(LC_TIME, "fr_FR");

		foreach ($results as $evenement) {
			echo "<p>";
				echo "<span class='event-title'>".ucfirst(strtolower($evenement->title))." </span>";
				//echo "<span class='event-date'>".date($format, strtotime($evenement->date))."</span>";
				echo strftime("le %A %e %B", strtotime($evenement->date));
			echo "</p>";
		}

		echo $args['after_widget'];
	}
}
