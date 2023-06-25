<?php

function voirFiches(){
    if (isset($_GET['etat'])) {
        $fiches = getFichesByEtat(null, $_GET['etat']);
    }else {
        $fiches = getFichesByEtat(null, null);
    }

    View('fiches/fichesView', ['fiches' => $fiches]);
}

/**
 * @method GET url = comptable/fiche
 * @View fiche.php
 * @author Aloïs Hias
 */
function voirFiche(){
    $fiche_id = $_GET['fiche'];
    $fiche = getFiche($fiche_id);
    $etats = getEtat();

    View('fiches/ficheView', ['frais' => getFraisForfaitFiche($fiche_id),'fraisHorsForfait' => getFraisHorsForfaitFiche($fiche_id), 'user' => getUser($fiche['ID_USER']), 'fiche' => $fiche, 'etats' => getEtat()]);
}


/**
 * @method GET url = comptable/fiche
 * @View fiche.php
 * @author Aloïs Hias
 */
function updateFicheComptable(){
    $etat_fiche = $_POST['etat_fiche'];
    $id_fiche = $_POST['id_fiche'];
    $nombre_justificatif = $_POST['nombre_justificatif'];

    updateEtat($etat_fiche, $id_fiche, $nombre_justificatif);

    header("Location: ?url=fiches");
}
