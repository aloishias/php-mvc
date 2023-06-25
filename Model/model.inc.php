<?php
/**
 * Cette fonction donne une connection à la base de donnée en fonction de ses paramètres
 * @param $host string, $user string, $password string, $bdd string
 * @return BDD connection
 * @author Augustin de Latrollière
 */
function connectBdd($host = 'localhost', $user = 'root', $password = 'root', $bdd = 'lbc')
{

    $base = mysqli_connect($host, $user, $password, $bdd);
    mysqli_query($base, 'SET NAMES UTF8');

    if (mysqli_connect_errno()) {
            printf("Échec de la connexion : %s\n", mysqli_connect_error());
            exit();
    }

    return $base;
}

/**
 * Cette fonction retourne le résultat d'une requête sous forme de tableau
 * Ou l'execution d'une requête sans retourner de tableau
 * @param $sql string, $rez boolean
 * @return $data en tableau, ou en string
 * @author Augustin de Latrollière
 */
function req($sql, $rez = false)
{
    $req = mysqli_query(connectBdd(), $sql) or die('Erreur');

    if ($rez) {
        # récupération des résultats sous forme de tableau en fonction de la requete
        $data = mysqli_fetch_all($req,MYSQLI_ASSOC);

        # Vide la mémoire SQL
    mysqli_free_result($req);
    }else{
        $data = $req;
    }

    # Fermeture de la fonction SQL
    mysqli_close(connectBdd());

    return $data;
}

//vérifie que l'utilisateur existe
function VerifLogin($login, $mdp){
		return req("SELECT * FROM user WHERE login='$login' AND mdp='$mdp'", true);
}

/**
 * Cette fonction retourne les frais régulier
 * FicheController.php | creation() | getFraisForfait()
 * @return Array
 * @author Augustin de Latrollière
 */
function getFraisForfait(){
    return req("SELECT * FROM fraisforfait", true);
}

/**
 * Cette fonction retourne les fiches de frais d'un utilisateur
 * En fonction ou non d'un etat
 * FicheController.php | voirFiches()
 * @param $user string, $etat string
 * @return Array
 * @author Augustin de Latrollière
 */
function getFichesByEtat($user, $etat){
    if (isset($user)) {
        if (isset($etat)) {
            return req("SELECT fichefrais.*, etat.LIBELLE FROM fichefrais, etat WHERE fichefrais.ID_ETAT = etat.ID AND ID_ETAT = '$etat' AND ID_USER = '$user'", true);
        }
        return req("SELECT fichefrais.*, etat.LIBELLE FROM fichefrais, etat WHERE fichefrais.ID_ETAT = etat.ID AND ID_USER = '$user'", true);
    }
    if (isset($etat)) {
        return req("SELECT fichefrais.*, etat.LIBELLE FROM fichefrais, etat WHERE fichefrais.ID_ETAT = etat.ID AND ID_ETAT = '$etat'", true);
    }
    return req("SELECT fichefrais.*, etat.LIBELLE FROM fichefrais, etat WHERE fichefrais.ID_ETAT = etat.ID", true);

}

/**
 * Cette fonction retourne une fiches de frais
 * FicheController.php | modifier()
 * @param $fiche string
 * @return Array
 * @author Augustin de Latrollière
 */
function getFiche($fiche){
	return req("SELECT * FROM fichefrais WHERE ID = $fiche", true)[0];
}

/**
 * Cette fonction retourne les frais de forfait
 * d'une fiches de frais
 * FicheController.php | modifier()
 * @param $fiche string
 * @return Array
 * @author Augustin de Latrollière
 */
function getFraisForfaitFiche($fiche){
	return req("SELECT * FROM lignefraisforfait, fraisforfait WHERE lignefraisforfait.ID_FICHE = $fiche AND lignefraisforfait.ID_FRAIS=fraisforfait.ID", true);
}

/**
 * Cette fonction retourne les frais hors forfait
 * d'une fiches de frais
 * FicheController.php | modifier()
 * @param $fiche string
 * @return Array
 * @author Augustin de Latrollière
 */
function getFraisHorsForfaitFiche($fiche){
	return req("SELECT * FROM lignefraishorsforfait WHERE ID_FICHE = $fiche", true);
}

function showFicheNonCloture(){
	return req("SELECT fichefrais.ID, NBJUSTIFICATIFS,DATEFICHE, user.NOM, user.PRENOM, etat.LIBELLE FROM FICHEFRAIS, USER, ETAT WHERE USER.ID=fichefrais.ID_USER AND etat.ID=fichefrais.ID_ETAT", true);
}

function getUsers(){
    return req("SELECT * FROM user WHERE COMPTABLE = 0");
}

/**
 * Cette fonction retourne un utilisateur
 * en fonction de son id
 * FicheController.php | modifier() | creation()
 * @param $user string
 * @return Array
 * @author Augustin de Latrollière
 */
function getUser($user){
	return req("SELECT * FROM user WHERE ID = '$user'", true)[0];
}

/**
 * Cette fonction creer une fiche
 * Et retourne cette fiche sous forme de tableau
 * FicheController.php | create()
 * @param $date String, $user String, $etat String
 * @return Array
 * @author Augustin de Latrollière
 */
function createFiche($date, $user, $etat){
    req("INSERT INTO fichefrais(ID, NBJUSTIFICATIFS, DATEFICHE, ID_USER, ID_ETAT) VALUES (NULL, NULL, '$date', '$user', '$etat')");
    return req("SELECT * FROM fichefrais ORDER BY ID DESC LIMIT 1", true);
}

/**
 * Cette fonction creer les frais forfait d'une fiche
 * FicheController.php | create()
 * @param $fiche Int, $frais String, $qte Int
 * @author Augustin de Latrollière
 */
function createFraisFiche($fiche, $frais, $qte){

    req("INSERT INTO `lignefraisforfait`(`ID_FICHE`, `ID_FRAIS`, `QUANTITE`) VALUES ($fiche, '$frais', $qte)");
}

/**
 * Cette fonction creer les frais hors forfait d'une fiche
 * FicheController.php | create()
 * @param $libelle String, $date String, $montant Double, $fiche Int
 * @author Augustin de Latrollière
 */
function createFraisHorsForfFiche($libelle, $date, $montant, $fiche){
	req("INSERT INTO lignefraishorsforfait(ID, LIBELLE, DATEFRAIS, MONTANT, ID_FICHE) VALUES (NULL, '$libelle', '$date', '$montant', '$fiche')");
}

/**
 * Cette fonction modifie une fiche de frais
 * FicheController.php | update()
 * @param $fiche_id Int, $data Array
 * @author Augustin de Latrollière
 */
function updateFiche($fiche_id, $data){
	$montant = 0;
	// Modification de la date de la fiche
	req("UPDATE fichefrais SET DATEFICHE='" . $data['date_fiche']. "' WHERE ID = ".$fiche_id);

	// Supression des frais
	req("DELETE FROM lignefraisforfait WHERE ID_FICHE = " . $fiche_id);
	req("DELETE FROM lignefraishorsforfait WHERE ID_FICHE = " . $fiche_id);


	// Creation des nouveaux frais
	foreach ($data['nb_utilisation'] as $frais => $qte) {
        if ($qte > 0) {
            createFraisFiche($fiche_id, $frais, $qte);
            $montant += floatval(getPrixFrais($frais)) * intval($qte);
        }
    }

    if (isset($data['date_autre_frais'])) {
        for ($i=0; $i < count($_POST['date_autre_frais']); $i++) {
            createFraisHorsForfFiche($data['libelle_autre_frais'][$i], $data['date_autre_frais'][$i], $data['montant_autre_frais'][$i], $fiche_id);
            $montant += $data['montant_autre_frais'][$i];
        }
    }

    modifierMontantFiche($fiche_id, $montant);
}

/**
 * Cette fonction supprime une fiche de frais
 * FicheController.php | supression()
 * @param $fiche Int
 * @author Augustin de Latrollière
 */
function deleteFiche($fiche){
	// Supression des frais
	req("DELETE FROM lignefraisforfait WHERE ID_FICHE = " . $fiche);
	req("DELETE FROM lignefraishorsforfait WHERE ID_FICHE = " . $fiche);
	// Supression de la fiche
	req("DELETE FROM fichefrais WHERE ID = " . $fiche);
}

/**
 * Cette fonction donne le prix d'un frais
 * FicheController.php | create()
 * @param $frais String
 * @return Double
 * @author Augustin de Latrollière
 */
function getPrixFrais($frais){
	return req("SELECT MONTANT FROM fraisforfait WHERE ID = '$frais'", true)[0]['MONTANT'];
}

/**
 * Cette fonction permet la modification du montant d'une fiche
 * FicheController.php | create()
 * @param $frais String
 * @author Augustin de Latrollière
 */
function modifierMontantFiche($fiche, $montant){
	req("UPDATE fichefrais SET MONTANT = $montant WHERE ID = $fiche");
}

/**
 * Cette fonction permet de récupérer l'état d'une fiche
 * FicheComptableController.php |
 * @param $id
 * @author Aloïs HIAS
 */
 function getEtatFiche($fiche_id){
   return req("SELECT libelle FROM etat, fichefrais WHERE fichefrais.ID_ETAT=etat.ID AND fichefrais.ID= $fiche_id");
 }

 /**
  * Cette fonction permet de récupérer les états qu'une fiche peut avoir
  * FicheComptableController.php |
  * @param $id
  * @author Aloïs HIAS
  */
  function getEtat(){
    return req("SELECT * FROM etat");
  }

  /**
   * Cette fonction permet de modifier l'état d'une fiche
   * FicheComptableController.php |
   * @param $id
   * @author Aloïs HIAS
   */
   function updateEtat($etat_fiche, $id_fiche, $nombre_justificatif){
       $nombre_justificatif = empty($nombre_justificatif) ? 0 : $nombre_justificatif;
       req("UPDATE `fichefrais` SET NBJUSTIFICATIFS = $nombre_justificatif,ID_ETAT='$etat_fiche' WHERE ID = $id_fiche");
   }
/**
  * Cette fonction permet de récupérer l'état d'une fiche
  * HomeController.php |
  * @return Array
  * @author Augustin de Latrollière
  */
  function getSat($user = null){
      if (isset($user)) {
          return req("SELECT COUNT(*) as nb, etat.* FROM fichefrais, etat WHERE fichefrais.ID_ETAT = etat.ID AND fichefrais.ID_USER = '$user' GROUP BY etat.ID", true);
      }
      return req("SELECT COUNT(*) as nb, etat.* FROM fichefrais, etat WHERE fichefrais.ID_ETAT = etat.ID GROUP BY etat.ID", true);
  }

  function totalFiches($user = null){
      if (isset($user)) {
          return req("SELECT COUNT(*) as nb FROM fichefrais WHERE ID_USER = '$user'", true)[0]['nb'];
      }
      return req("SELECT COUNT(*) as nb FROM fichefrais", true)[0]['nb'];
  }

  function getEtats(){
      return req("SELECT * FROM etat", true);
  }

/**
 * Regarde si une fiche pour le mois en cours existe déjà pour un client
 * FicheClientController.php |
 * @return Array
 * @author Cédric Hamel
 */
function verifFicheDuMois($user_id, $date){
    $date= new DateTime($date);
    $date = $date->format("Y-m");
    return req("SELECT * FROM fichefrais WHERE DATEFICHE LIKE '".$date."-%' AND ID_USER='".$user_id."'", true);
}

/**
 * Récupère l'ID de la fiche du mois précéddent si cette dernière n'est pas cloturée
 * FicheClientController.php |
 * @author Cédric Hamel
 */
function getIDFicheMoisPrecedent($user_id, $annee, $mois){
    return req('SELECT ID FROM fichefrais WHERE DATEFICHE LIKE "'.$annee.'-'.$mois.'-%" AND ID_USER="'.$user_id.'" AND ID_ETAT="CR"', true);
}

/**
 * Permet de cloturé une fiche dont on passe l'id en paramètre
 * FicheClientController.php |
 * @author Cédric Hamel
 */
function modifierEtatFiche($idFiche){
    req('UPDATE FICHEFRAIS SET ID_ETAT="CL" WHERE ID="'.$idFiche['ID'].'"');
}
