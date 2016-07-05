<?php
/*
Template Name: Archives chronologique
*/

get_header();
?>

<div><?php the_content(); ?></div>

<?php

$previous_year = $year = 0;
$previous_month = $month = 0;
$ul_open = false;

$myposts = get_posts('numberposts=-1&orderby=post_date&order=DESC');

foreach($myposts as $post){

	setup_postdata($post);

	$year = mysql2date('Y', $post->post_date);
	$month = mysql2date('n', $post->post_date);
	$day = mysql2date('j', $post->post_date);

	if($year != $previous_year || $month != $previous_month){
		if($ul_open == true){
			echo '</ul>';
		}
		?>

		<h3><?php the_time('F Y'); ?></h3>

		<ul>
			<?php $ul_open = true;
	}
	$previous_year = $year; 
	$previous_month = $month; ?>

	<li>
		<span><?php the_time('j F'); ?> - </span>
		<span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>
	</li>
<?php 
}

echo '</ul>';

if(is_active_sidebar('sidebar')){
	echo "<div id='sidebar'>";
		echo "<ul>";
			dynamic_sidebar('sidebar');	
		echo "</ul>";
	echo "</div>";
}

get_footer();
