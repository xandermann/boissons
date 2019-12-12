<?php

namespace App\Controllers;

use App\Controllers\Controller;

class RechercheController extends Controller {

	public function recherche() {

		require('../src/Modeles/Donnees.inc.php');

		$this->render('recherche');
	}

	public function rechercher() {
		require('../src/Modeles/Donnees.inc.php');
		//header('Content-Type: application/json');

		$recherche = $_GET['q'] ?? '';
		$recherche = explode(",", $recherche);

		var_dump($recherche);

		$resultat = array_filter($Recettes, function($recette) use ($recherche) {
			// Tester si pour chaque index ça match, si oui, alors return true

			return !empty(array_intersect($recette['index'], $recherche));
			die;

			return in_array('Malibu', $recette['index']);
		});

		//var_dump($recherche);

		var_dump($resultat);

		/*
		$Recettes = array_map(function($recette) {
			return strtolower($recette['titre']);
		}, $Recettes);

		$ret = array_filter($Recettes, function($recette) use ($recherche) {
			return preg_match("/$recherche/", $recette);
		});

		//echo "La recette $recette";
		//var_dump($ret);


		echo json_encode($ret);
		*/

	}

}
