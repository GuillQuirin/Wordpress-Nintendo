<?php
class Date
{
	var $days   = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
	var $months= array('JANVIER', 'FEVRIER', 'MARS', 'AVRIL', 'MAI', 'JUIN', 'JUILLET', 'AOUT', 'SEPTEMBRE', 'OCTOBRE', 'NOVEMBRE', 'DECEMBRE');
	
	function getall($year)
	{ // On récupère les jours de chaque année en fonction de la date exacte
		$r = array();
		$date =strtotime($year.'-01-01');
		while(date('Y', $date) <= $year)
		{
			$y = date('Y',$date);
			$m = date('n',$date);
			$d = date('j',$date);
			$w = str_replace('0', '7', date('w',$date)); // On met dimanche en 7 au lieu de 0
			$r[$y][$m][$d]= $w;
			$date = $date + 24*3600;
		}
		return $r;
	}
}
?>