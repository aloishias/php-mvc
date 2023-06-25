<?php
//permet d'afficher la page d'identification
function showLogin(){
  require('Views/auth/login.php');
}

//permet de récupérer les informations de la page
function auth(){
  $login = $_POST['login'];
  $mdp = $_POST['mdp'];

  //permet de vérifier que l'utilisateur existe
  $user = VerifLogin($login, $mdp);

  if (!empty($user)) {
      $userId = $user[0]['ID'];
      $_SESSION['id'] = $userId;
      
      if (isset($user[0]['COMPTABLE']) && $user[0]['COMPTABLE'] == '1') {
          $_SESSION['admin'] = true;
      }
      header("Location: ?url=");
  }else {
      // revonyer un message d'erreur genre le mot passeou l'id ne sont alid
      // echo("Le mot de passe ou le login n'est pas valide.");
      // showLogin();

      header("Location: ?url=login&err=1&login=". $_POST['login']);
  }

}

function logout(){
    session_destroy();
    session_unset();

    header("Location: ?url=");
}
