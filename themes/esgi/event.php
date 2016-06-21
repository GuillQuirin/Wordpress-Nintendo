<?php

class Evenement extends WP_Widget
{

    public function __construct()
    {
        parent::__construct('ajout', 'Gestion Evenement', array('description' => 'Pour gérer les evénements'));
    }

    function widget($args, $instance)
    {
        echo $args['before_widget'];

        global $wpdb;

        echo "<form action=\"./forums/login.php?action=in\" method=\"post\">

	          <input type=\"text\" name=\"ajout\" />
	          <input type=\"text\" name=\"delete\"  />

	          <input type=\"submit\" name=\"Excecuter\" value=\"OK\" />
              </form>";

    }
}
