<?php
class ajoutE extends WP_Widget{

    public function __construct(){
        parent::__construct('next-event', 'Evenement à venir', array('description' => 'Prochain évènement.'));
    }

    function widget($args, $instance){
        echo $args['before_widget'];

        global $wpdb;