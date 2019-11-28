<?php

$page = $_GET['page'] ?? header('Location: index.php?page=accueil');

switch($page) {
	case 'accueil':
		require('vues/accueil.php');
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

