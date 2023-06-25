<?php
	 	session_start();

		require 'Functions/auth.inc.php'; // fichier avec les fonctions d'authentification
		require 'Functions/general.inc.php'; // fichier avec les fonctions générales
		require 'Model/model.inc.php'; // fichier avec les fonctions générales

		if (!isset($_GET['url'])) {
			header('location: ?url=');
		}

		cloturationGenerale();

		$method = $_SERVER['REQUEST_METHOD']; // récupération de la méthode http
		$url = $_GET['url']; // récupération de l'url appelée

		# Url avec la méthode get
		if ($method == 'GET') {

			# Pages d'authentification
			switch ($url) {
				case '':
					mustBeLoged();
					require 'Controllers/HomeController.php';
					showHome();
					break;

				case 'login':
					require 'Controllers/AuthController.php';
					showLogin();
					break;

				case 'logout':
					require 'Controllers/AuthController.php';
					logout();
					break;

			}

			# Pages des clients
			if (isLoged() && !isAdmin()) {
				switch ($url) {

					case 'login':
						require 'Controllers/AuthController.php';
						showLogin();
						break;

					case 'logout':
						require 'Controllers/AuthController.php';
						logout();
						break;

					case 'fiche':
						require 'Controllers/FicheControllerClient.php';
						voirFiche();
						break;

					case 'creation/fiche':
						require 'Controllers/FicheControllerClient.php';
						creation();
						break;

					case 'fiches':
						require 'Controllers/FicheControllerClient.php';
						voirFiches();
						break;

					case 'fiche':
						require 'Controllers/FicheControllerClient.php';
						voirFiche();
						break;

					case 'modifier/fiche':
						require 'Controllers/FicheControllerClient.php';
						modifier();
						break;

					case 'supprimer/fiche':
						require 'Controllers/FicheControllerClient.php';
						supprimer();
						break;

					default:
						if ($url != '') {
							mustBeLoged();
							require 'Controllers/HomeController.php';
							errorNotFound();
						}
						break;
				}
			}

			# Pages des comptables
			if (isLoged() && isAdmin()) {
				switch ($url) {
					case 'fiches':
						require 'Controllers/FicheControllerAdmin.php';
						voirFiches();
						break;
					case 'fiche':
						require 'Controllers/FicheControllerAdmin.php';
						voirFiche();
						break;
					default:
						if ($url != '') {
							mustBeLoged();
							require 'Controllers/HomeController.php';
							errorNotFound();
						}
						break;
				}
			}

		}

		# Url avec la méthode POST

		if ($method == 'POST'){
			switch ($url) {

				case 'login':
					require 'Controllers/AuthController.php';
					auth();
					break;

				case 'creation/fiche':
					require 'Controllers/FicheControllerClient.php';
					create();
					cloturation();
					break;

				case 'modifier/fiche':
					require 'Controllers/FicheControllerClient.php';
					update();
					break;

				case 'modifier/fiche/comptable':
					require 'Controllers/FicheControllerAdmin.php';
					updateFicheComptable();
					break;
			}

		}
