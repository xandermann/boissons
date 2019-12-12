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

		// Ici on trie (fonction recherche)
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
		});

		// Ici, on renvoie seulement le titre
		$resultat = array_map(function($recette) {
			return $recette['titre'];
		}, $resultat);

		echo json_encode($resultat);

	}

}
