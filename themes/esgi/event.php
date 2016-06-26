<?php

class Evenement extends WP_Widget
{

    public function __construct()
    {
        parent::__construct('ajout', 'Infos Evenement', array('description' => 'Affichage du prochain évènement'));
    }

    function widget($args, $instance)
    {
        echo $args['before_widget'];

        global $wpdb;

        echo "<h3>Prochain évènement:</h3>";

        $results = $wpdb->get_results("SELECT * FROM wp_options ORDER BY option_id LIMIT 1");
        
       if($results){
         echo $results[0]->option_name;
       }
    }
}
