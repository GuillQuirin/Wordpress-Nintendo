<?php

/*
Plugin Name: Calendrier
Plugin URI: www.google.com
Description: Un nouveau plugin
Version: 00
Author: Rayz
Author URI: www.google.com
License: creative common
*/

require('Fonctions.php');
require('BDD.php');
// On utilise la foncion de Date1.php pour récupérer la date actuelle
$date = new Date();
$year = date('Y');
$moisactuel= date('m');
$dates = $date->getAll($year);
?>


<div class="year">
    <?php echo $year; ?>
</div> <!-- Affichage de l'année -->
<div class="months">
    <?php foreach ($date->months as $id=>$m)
    { ?> <!-- Attribution d'un id à chaque lien de mois en fonction de son numéro -->
        <a href="#" id="linkmonth<?php echo $id+1; ?>">
            <?php echo substr($m,0,3); ?>
        </a> <!-- Lien avec affichage des 3 premières lettres du mois -->
    <?php }; ?>
</div>
<?php $dates=current($dates); ?>
<?php foreach ($dates as $m=>$days)
{ ?> <!-- Attribution d'un id à chaque mois en fonction de son numéro -->
    <div class="month" id="month<?php echo $m; ?>">
        <table>
            <thead>
            <tr>
                <?php foreach($date->days as $d)
                { ?>  <!-- Affichage des jours de la semaine avec leur 3 premières lettres -->
                    <th>
                        <?php echo substr($d,0,3); ?>
                    </th>
                <?php }; ?>
            </tr>
            </thead>
            <tbody>
            <tr>
                <?php $end=end($days);
                foreach($days as $d=>$w)
                { ?>
                <?php $time = strtotime("$year-$m-$d"); ?> <!-- On initialise une variable où on stocke la date de chaque jour au moment du traitement -->
                <?php if($m!=9 && $m!=12 && $d ==1)
                { ?>
                    <td colspan="<?php echo $w-1; ?>"></td> <!-- Ajout de colonne vide par rapport au premier jour du mois à afficher -->
                <?php }; ?>
                <td>
                    <div class="day"><?php
                        if(isset($events[$time])) //S'il existe un évènement à la date traitée, on affiche un indicateur en plus du jour
                        {
                            $poke=0;
                            foreach($events[$time] as $e)
                            {
                                if($poke==0)
                                {
                                    echo "<a href=\"Calendrier2.php\">$d</a>"; //Redirection de l'évènement vers le Gros Calendrier
                                    echo "<img class=\"pokeball\" alt=\"Pokeball\" src=\"Image/Pokeball.gif\">";
                                    $poke=1;
                                }
                            }
                        }
                        else
                        {
                            echo $d;
                        }
                        ?>
                    </div>
                </td>
                <?php if($w == 7)
                { ?> <!-- Quand on arrive à la fin de la semaine on passe à une nouvelle ligne -->
            </tr>
            <tr>
                <?php }; ?>
                <?php }; ?>
                <?php if($end !=7)
                { ?>
                    <td colspan="<?php echo 7-$end; ?>"></td> <!-- Ajout de colonne vide à la fin du tableau en fonction du jour pour l'uniformiser et éviter les décalages-->
                <?php }; ?>
            </tr>
            </tbody>
        </table>
    </div>
<?php }; ?>

<script>
    $('.month').hide();
    $('.month:first').show(); // Permet de montrer uniquement un mois
    var current = 1;
    $('.months a').click(
        function()
        {
            var month = $(this).attr('id').replace('linkmonth',''); // La variable month prend l'ID du mois sur le quel on a cliqué
            if(month != current)
            {
                $('#month'+current).slideUp(); // Quand on clique sur un lien le mois demandé défile
                $('#month'+month).slideDown();
                current = month;
            }
            return false;
        });
</script>
