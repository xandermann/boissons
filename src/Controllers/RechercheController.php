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
		$ingredientsDansLarecherche = explode(",", $recherche);

		var_dump($recherche);

		$resultat = array_filter($Recettes, function($recette) use ($ingredientsDansLarecherche) {


			// $ingredientsDansLarecherche <- C'est un tableau qui contient tout les ingredients qu'on cherche
			// ingredientsDansLaRecette <- Liste des ingredients dans la recette
			$ingredientsDansLaRecette = $recette['index'];


			foreach($ingredientsDansLarecherche as $ingredient) {
				if (in_array($ingredient, $ingredientsDansLaRecette)) {
					// Alors ok
				} else {
					return false;
				}

			}
			return true;

			//return !empty(array_intersect($ingredientsDansLaRecette, $recherche));
			// return in_array('Malibu', ingredientsDansLaRecette);
			//
			return true; // Ici, il faut retourner true si ce qu'il y a les ingredients recherchés dans les ingredients dans la recette
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
