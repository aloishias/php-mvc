<?php

mustBeLoged();

/**
 * @method GET url = fiche
 * @View fiche.php
 * @author Aloïs Hias
 */
function voirFiche(){
    $fiche_id = $_GET['fiche'];
    $fiche = getFiche($fiche_id);
    $user = getUserAuth();

    if ($fiche['ID_USER'] != $user['ID']) {
        View('404');
    }else {
        View('fiches/VoirFicheView', ['frais' => getFraisForfaitFiche($fiche_id),'fraisHorsForfait' => getFraisHorsForfaitFiche($fiche_id), 'user' => $user, 'fiche' => $fiche]);
    }
}

/**
 * @method GET url = client/fiches
 * @View FichesClientView.php
 * @author Augustin de Latrollière
 */
function voirFiches(){
    $user_id = getUserAuth()['ID'];
    if (isset($_GET['etat'])) {
        $fiches = getFichesByEtat($user_id, $_GET['etat']);
    }else {
        $fiches = getFichesByEtat($user_id, null);
    }

    View('fiches/FichesClientView', ['fiches' => $fiches]);
}

/**
 * @method GET url = creation/fiche
 * @View CreationView.php
 * @author Augustin de Latrollière
 */
function creation(){
    View('fiches/CreationView', ['frais' => getFraisForfait(), 'user' => getUserAuth()]);
}


/**
 * @method POST url = creation/fiche
 * @author Augustin de Latrollière
 */
function create(){
    $user_id = getUserAuth()['ID'];
    $etat = 'CR';
    $montant = 0;

    if (empty(verifFicheDuMois(getUserAuth()['ID'], $_POST['date_fiche']))) {
        $fiche = createFiche($_POST['date_fiche'], $user_id, $etat)[0];

        foreach ($_POST['nb_utilisation'] as $frais => $qte) {
            if ($qte > 0) {
                createFraisFiche($fiche['ID'], $frais, $qte);
                $montant += floatval(getPrixFrais($frais)) * intval($qte);
            }
        }

        if (isset($_POST['date_autre_frais'])) {
            for ($i=0; $i < count($_POST['date_autre_frais']); $i++) {
                createFraisHorsForfFiche($_POST['libelle_autre_frais'][$i], $_POST['date_autre_frais'][$i], $_POST['montant_autre_frais'][$i], $fiche['ID']);
                $montant += $_POST['montant_autre_frais'][$i];
            }
        }

        modifierMontantFiche($fiche['ID'], $montant);
        header("location: ?url=fiches&etat=CR");
    }else {
        header('location: ?url=creation/fiche&err=La fiche de ce mois est déjà créé !');
    }
}

/**
 * @method GET url = modifier/fiche
 * @View ModificationView.php
 * @author Augustin de Latrollière
 */
function modifier(){
    $fiche_id = $_GET['fiche'];
    $fiche = getFiche($fiche_id);
    $frais = getFraisForfait();
    $fraisForfait = getFraisForfaitFiche($fiche_id);
    $fraisHorsForfait = getFraisHorsForfaitFiche($fiche_id);

    foreach ($frais as $key => $f) {
        foreach ($fraisForfait as $fF) {
            if ($f['ID'] == $fF['ID']) {
                $frais[$key] = $fF;
            }else if (empty($frais[$key]['QUANTITE'])) {
                $frais[$key]['QUANTITE'] = '0';
            }
        }
    }

    View('fiches/ModificationView', ['fiche' => $fiche, 'frais' => $frais, 'fraisHorsForfait' => $fraisHorsForfait, 'user' => getUserAuth()]);
}

/**
 * @method POST url = modifier/fiche
 * @author Augustin de Latrollière
 */
function update(){
    updateFiche($_GET['fiche'], $_POST);
    header("location: ?url=fiches&etat=CR");
}

/**
 * @method GET url = supprimer/fiche
 * @author Augustin de Latrollière
 */
function supprimer(){
    deleteFiche($_GET['fiche']);
    header("location: ?url=fiches&etat=CR");
}

function cloturation(){
    $user_id = getUserAuth()['ID'];
    $annee=date("Y");
    $mois=date("m")-1;

    //Dans la cas ou on passe de janvier à décembre
    if($mois==0) {
        $mois=12; //Il faut donc manuellement placé le 12
        $annee=$annee-1; //Et repassé sur l'année précédente
    }

    $idFiche = getIDFicheMoisPrecedent($user_id, $annee, $mois);

    if(!empty($idFiche)) {
        foreach ($idFiche as $fiche) {
             modifierEtatFiche($fiche);
        }
    }
}
