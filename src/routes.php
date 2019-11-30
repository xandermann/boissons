<?php

$page = $_GET['page'] ?? header('Location: index.php?page=accueil');

switch($page) {
	case 'accueil':
		(new App\Controllers\AccueilController())->accueil();
		break;

	case 'recettes_preferees':
		(new App\Controllers\AccueilController())->recettesPreferees();
		break;

	case 'connexion':
		(new App\Controllers\UtilisateurController())->connexion();
		break;

	case 'inscription':
		(new App\Controllers\UtilisateurController())->inscription();
		break;

	default:
		echo 'Page 404, aucune page trouvée';
		break;
}

