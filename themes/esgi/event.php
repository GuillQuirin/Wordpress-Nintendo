<?php
setlocale(LC_TIME, 'fr_FR');
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
        
        $results = $wpdb->get_results("SELECT id, post_title,
                                        DATE_FORMAT(post_content, '%Y-%m-%d') as date_event,
                                        DATEDIFF(DATE_FORMAT(post_content, '%Y-%m-%d'), CURDATE())
                                        FROM wp_posts
                                        WHERE 
                                            DATE_FORMAT(post_content, '%Y-%m-%d') IS NOT NULL
                                        AND DATEDIFF(DATE_FORMAT(post_content, '%Y-%m-%d'), CURDATE())>0
                                        ORDER BY DATEDIFF(DATE_FORMAT(post_content, '%Y-%m-%d'), CURDATE()) ASC 
                                        LIMIT 1");

        if($results && is_array($results)){
            foreach($results as $evenement){
                if($results && $evenement->date_event !== NULL){
                    echo "<p>".strtoupper($evenement->post_title)."</p>";
                    echo "<p>Prévu pour le";
                        echo strftime(' %e ', strtotime($evenement->date_event));
                        echo ucfirst(strftime('%B', strtotime($evenement->date_event)));
                        echo strftime(' %Y ', strtotime($evenement->date_event));
                    echo "</p>";
                    break;
                }
            }
        }
    }
}
