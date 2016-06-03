<?php
	function upload($nom,$taille,$extension) //Vérification de l'upload des images d'avatar
	{
		if($_FILES[$nom]['error']==0) 
			{
				if($_FILES[$nom]['size']<=5000000)
				{
					$extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');
					if( in_array($extension, $extensions_autorisees))
					{
						return 4;
					}
					else return 3;
				}
				else return 2;
			}		
	}

	function checkpseudo($pseudo)//Vérification du pseudo déjà existant
	{
		include("Base_donnees.php");

		$ok=1;
		$requete ="select membre_pseudo from membre";
		$res=@mysqli_query($cx, $requete);
		while(($donnees=mysqli_fetch_array($res))!=false)
		{
			if($donnees['membre_pseudo']==$pseudo) // Le pseudo a déjà été pris
			{
				$ok=0;
			}
		}
		return $ok;
	}

	function checkmdp($mdp, $mdpverif)//Vérification de la similitude des MDP
	{
		include("Base_donnees.php");
		$ok=1;
		if($mdp!=$mdpverif) // Le mot de passe ne correspond pas à la vérification
			{
			$ok=0;
			}
		return $ok;
	}

	function controlmail($mail)//Vérification du mail déjà existant
	{
		include("Base_donnees.php");

		$ok=1;
		$requete ="SELECT membre_mail from membre";
		$res=@mysqli_query($cx, $requete);
		while(($donnees=mysqli_fetch_array($res))!=false)
		{
			if($donnees['membre_mail']==$mail) // Le pseudo a déjà été pris
			{
				$ok=0;
			}
		}
		return $ok;
	}

	function douane($id)//Anti-intrusion des visiteurs dans la partie Administration
	{
		include("Base_donnees.php");
		$ok=0;
		$requete="SELECT membre_id from membre where membre_admin=1";
		$res=@mysqli_query($cx, $requete);
		while(($donnees=mysqli_fetch_array($res))!=false)
			{
			if($id==$donnees['membre_id'])
				{$ok=1;}
			}
		return $ok;
	}

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



