<?php
//permet de savoir si l'utilisateur est connecté
function isLoged(){
	if(!empty($_SESSION['id'])){
		return true;
	}
	return false;
}

//s'il n'est pas identifié il est rediriger vers la page de connexion
function mustBeLoged(){
	if(!isLoged()){
		header("location: ?url=login");
	}
}

//permet de vérifier si l'utilisateur est un administrateur
function isAdmin(){
	if (!empty($_SESSION['admin'])){
		return true;
	}
	return false;
}

function getUserAuth(){
	return getUser($_SESSION['id']);
}
