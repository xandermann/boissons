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
		header('Content-Type: application/json');

		$recherche = $_GET['q'] ?? '';

		$Recettes = array_map(function($recette) {
			return strtolower($recette['titre']);
		}, $Recettes);

		$ret = array_filter($Recettes, function($recette) use ($recherche) {
			return preg_match("/$recherche/", $recette);
		});

		//echo "La recette $recette";
		//var_dump($ret);


		echo json_encode($ret);

	}

}
