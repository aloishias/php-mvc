<?php
/**
 * Fonctions relatives aux controllers *
 */

/**
 * @param $v String
 * Cette fonction permet d'inclure des vues
 */
 function View($v, $data = []){
     extract($data);
     if (isset($_SESSION['admin'])) {
         require('Views/template/headerAdmin.php');
         require('Views/Comptable/'.$v.'.php');
         require('Views/template/footerAdmin.php');
     }else {
         require('Views/template/header.php');
         require('Views/Client/'.$v.'.php');
         require('Views/template/footer.php');
     }
 }

 function header_title($titre){
     return ("
         <div class='row'>
             <div class='col-lg-12'>
                 <h1 class='page-header'>$titre</h1>
             </div>
         </div>
     ");
 }

function cloturationGenerale(){
    $jour=date("d"); //On récupère le jour
    $mois=date("m")-1; //On récupère le mois précédent
    $annee=date("Y"); //On récupère l'annee

    if($mois == 0) //Si nous sommes en janvier on va avoir 0 pour décembre donc on doit prévoir ce cas d'utilisation
        $mois = 12; //donc décembre

     //Début de la campagne de validation le 10ème du mois
    if($jour >= 10) {
        $idFiche = req('SELECT ID FROM fichefrais WHERE DATEFICHE LIKE "'.$annee.'-'.$mois.'-%" AND ID_ETAT="CR"', true); //On récupère toutes les fiches créés du mois précédent

        if(!empty($idFiche)) {
            //On cloture toutes les fiches du mois précédent celui du début de la campagne de validation
            foreach ($idFiche as $fiche) {
                 req('UPDATE FICHEFRAIS SET ID_ETAT="CL" WHERE id='.$fiche['ID']);
            }
        }
    }
}
