<?php
//set_time_limit(0);
//ignore_user_abort(1);
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=lbc;charset=utf8', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

/*
----------------------------------------------------------------------------------
-----------Script de début de campagne de validation------------------------------
Se déclenche tous les 10 du mois, et cloture les fiches entamées le mois précédent
----------------------------------------------------------------------------------
*/

$jour=date("d"); //On récupère le jour
$mois=date("m")-1; //On récupère le mois précédent
$annee=date("Y"); //On récupère l'annee

if($mois==0) //Si nous sommes en janvier on va avoir 0 pour décembre donc on doit prévoir ce cas d'utilisation
	$mois=12; //donc décembre

if($jour>=10) //Début de la campagne de validation le 10ème du mois
{
	$rep = $bdd->query('SELECT id FROM fichefrais WHERE DATEFICHE LIKE "'.$annee.'-'.$mois.'-%" AND ID_ETAT="CR"'); //On récupère toutes les fiches créés du mois précédent
	while ($donnees = $rep->fetch())
	{
		//On cloture toutes les fiches du mois précédent celui du début de la campagne de validation
		$cloturation = $bdd->query('UPDATE FICHEFRAIS SET ID_ETAT="CL" WHERE id="'.$donnees['id'].'"');
	}
}

/*----------------------------------------------------------------------------------
-----------LORS DE LA CREATION D'UNE FICHE ON CLOTURE LA FICHE DU MOIS PRÉCEDENT----
----------------------------------------------------------------------------------*/

$annee=date("Y");
$mois=date("m")-1;
$rep = $bdd->query('SELECT id FROM fichefrais WHERE DATEFICHE LIKE "'.$annee.'-'.$mois.'-%" AND ID_USER="a131" AND ID_ETAT="CR"');
while ($donnees = $rep->fetch())
	{
		//On cloture la fiche du mois précédent de l'utilisateur actuel
		$cloturation = $bdd->query('UPDATE FICHEFRAIS SET ID_ETAT="CL" WHERE id="'.$donnees['id'].'"');
	}
?>
