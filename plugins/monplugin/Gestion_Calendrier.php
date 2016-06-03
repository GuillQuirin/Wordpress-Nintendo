<?php
session_start();
if(empty($_SESSION['id']))
	header('Location: ../index.php');
else
{
	$id=$_SESSION['id'];
	include("../Fonctions.php");
	if(douane($id)!=1)
		header('Location: ../index.php');
}
include("../Base_donnees.php");
?>

<!DOCTYPE html>
<html lang='fr'>

<head >
	<title>Modifier le Calendrier</title>
	<?php include("head.html"); ?>


<div id="admin_calendrier">
	
<?php

// Vérification: est-ce qu'on veut supprimer un evenement ?
if (isset($_GET['supprimer_evenement'])) // Si l'on demande de supprimer un evenement
{
	// Alors on supprime l'evenement correspondant.
	$requete="delete from events WHERE id='{$_GET['supprimer_evenement']}'";
	$res=@mysqli_query($cx, $requete);
}
?>

<!--Liste des evenements enregistres-->
<table border="1"><form action="Gestion_Calendrier.php" method="post">
	<tr><td colspan="4"><center><a href="ajouter_evenement.php">Ajouter un evenement</a></center></td></tr>
	<tr><td>Modification</td><td>Suppression</td><td>Titre</td><td>Date</td></tr>
	
<?php 
	$requete ='select id, date,title from events order by date desc';
	$res=@mysqli_query($cx, $requete);
	
		while(($donnees=mysqli_fetch_array($res))!=false)
			{ ?>
			<tr>
				<td><?php echo '<a href="ajouter_evenement.php?modifier_evenement=' . $donnees['id'] . '">'; ?>Modifier</a></td>
				<td><?php echo '<a href="Gestion_Calendrier.php?supprimer_evenement=' . $donnees['id'] . '">'; ?>Supprimer</a></td>
				<td><?php echo htmlspecialchars($donnees['title']);?></td><td><?php $date = $donnees['date']; echo date("d/m/Y", strtotime($date)); ?></td>
			</tr>
			<?php
			}
?>
	</form>
</table>
</div>

</body>
<?php include("../Footer.php"); ?>
</html>