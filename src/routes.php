<?php

$page = $_GET['page'] ?? header('Location: index.php?page=accueil');

switch($page) {
	// Accueil
	case 'accueil':
		(new App\Controllers\AccueilController)->index();
		break;

	// Recettes
	case 'recette':
		(new App\Controllers\RecetteController)->index();
		break;

	case 'ajouter_recette':
		(new App\Controllers\RecetteController)->ajouter();
		break;

	case 'supprimer_recette':
		(new App\Controllers\RecetteController)->supprimer();
		break;

	case 'supprimer_recettes':
		(new App\Controllers\RecetteController)->supprimerTout();
		break;

	// Connexion
	case 'connexion':
		(new App\Controllers\UtilisateurController)->connexion();
		break;

	case 'inscription':
		(new App\Controllers\UtilisateurController)->inscription();
		break;

	case 'ajouter_utilisateur':
		(new App\Controllers\UtilisateurController)->ajouterUtilisateur();
		break;

	case 'se_connecter':
		(new App\Controllers\UtilisateurController)->seConnecter();
		break;

	case 'se_deconnecter':
		(new App\Controllers\UtilisateurController)->seDeconnecter();
		break;

	case 'recherche':
		(new App\Controllers\RechercheController)->recherche();
		break;

	case 'rechercher':
		(new App\Controllers\RechercheController)->rechercher();
		break;

	// 404
	default:
		echo 'Page 404, aucune page trouvée';
		break;
}

