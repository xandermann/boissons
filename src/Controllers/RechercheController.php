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

		$recetteAChercher = $_GET['q'] ?? '';

		/*
		$Recettes = array_map(function($recette) {
			return $recette['titre'];
		}, $Recettes);
		*/

		$recette = $Recettes[0]['titre'];

		var_dump($recette);


		//echo json_encode($ret);

	}

}
