<?php

$page = $_GET['page'] ?? header('Location: index.php?page=accueil');

switch($page) {
	case 'accueil':

		/* Code à mettre dans un controller */
		require('../src/modeles/Donnees.inc.php');
		$categorie = $_GET['categorie'] ?? 'Aliment';
		$hierarchie = $Hierarchie[$categorie] ?? header('Location: index.php?page=accueil&categorie=Aliment');
		/* Fin controller */

		require('vues/pages/accueil.php');
		break;

	case 'connexion':
		echo 'Connexion ici';
		break;

	case 'inscription':
		echo 'Inscription ici';
		break;

	default:
		echo 'Page 404, aucune page trouvée';
		break;
}

